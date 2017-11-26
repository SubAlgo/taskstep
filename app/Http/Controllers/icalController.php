<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

use App\task;
use DB;

class icalController extends Controller
{
    public function ical(Request $req) {


        $myObj = collect($req)->toJson();
        $data = json_decode($myObj);
        $myDate = $data->DateTime;
        $start_date = date('Y-m-d H:i:s', strtotime($myDate));
        
        $myTaskId = $data->taskId;
        $task = new task;
        $getTitle = $task->select('title')->where('id', $myTaskId)->get();
        $myTaskTitle = ($getTitle[0]->title);
        
        
        // set default timezone (PHP 5.4)
        date_default_timezone_set('asia/bangkok');

        // 1. Create new calendar
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        // 2. Create an event
        $vEvent = new \Eluceo\iCal\Component\Event();
        $vEvent->setDtStart(new \DateTime($myDate));
        $vEvent->setDtEnd(new \DateTime($myDate));
        
        $vEvent->setSummary($myTaskTitle);

        // Adding Timezone (optional)
        $vEvent->setUseTimezone(true);

        // 3. Add event to calendar
        $vCalendar->addComponent($vEvent);

        // 4. Set headers
        $headers = [
            'Content-type'          => 'text/calendar; charset=utf-8;',
            'Content-Disposition'   => 'attachment; filename=myical1.ics',
            "Pragma"                => "no-cache",
            "Cache-Control"         => "must-revalidate, post-check=0, pre-check=0",
            "Expires"               => "0"
        ];

        //Create File and Path
        $contents = $vCalendar->render();
        $filename = 'myical';
        $myPath = 'public\\';
        $filename_type = $filename.'.ics';
        $mixPath = $myPath.$filename_type; 
        
        /*Create .ics ไฟล์
        -----------------*/
        Storage::put($mixPath, $contents);
        

        /*Create StoragePath
        ------------------*/        
        $storagePath = storage_path('app\\'.$mixPath); //ที่เก็บไฟล์  C:\xampp\htdocs\task\storage\app\public\myical9.ics

        return response()->download($storagePath);
        //return response()->download($storagePath, $filename, $headers);
       
        //return response($start_date); 
    }

    public function multiCreateCsi(Request $req) {
        $myId = $req->input('list');

        $myObj = collect($myId)->toJson();
        $myData = json_decode($myObj);

        $genAppointId = [];
        $i = 0;
        foreach($myData as $data){
            $genAppointId[$i] = $data;
            $i++;
        }

        $dataDBs = DB::table('appoint')->join('task', 'appoint.task_id', '=', 'task.id')
                                       ->orderBy('appoint.id')
                                       ->select('appoint.id','appoint.date', 'task.title')
                                       ->whereIn('appoint.id', $genAppointId)
                                       ->get();
        
        //Set Time Zone                               
        date_default_timezone_set('asia/bangkok');
        // 1. Create new calendar
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        foreach($dataDBs as $dataDB) {
            // 2. Create an event
            $vEvent = new \Eluceo\iCal\Component\Event();
            $vEvent->setDtStart(new \DateTime($dataDB->date));
            $vEvent->setDtEnd(new \DateTime($dataDB->date));
            
            $vEvent->setSummary($dataDB->title);
            
            // Adding Timezone (optional)
            $vEvent->setUseTimezone(true);
        
            // 3. Add event to calendar
            $vCalendar->addComponent($vEvent);
        }
        /*4. Set headers
        ----------------*/
        
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename="cal223.ics"');
 
        /*5. Output
        -----------*/
        echo $vCalendar->render();

    }

    /*
    DB::table('appoint')
	->join('task', 'appoint.task_id', '=', 'task.id')
	->orderBy('appoint.id')
	->select('appoint.id','appoint.date', 'task.title')
	->whereIn('appoint.id', [1,2,3,6])
    ->get();
    */
}

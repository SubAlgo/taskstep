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
        //$vEvent->setDtStart(new \DateTime($start_date));
        //$vEvent->setDtEnd(new \DateTime($start_date));
        
        $vEvent->setSummary($myTaskTitle);
        
        /* Set recurrence rule (option)

        $recurrenceRule = new \Eluceo\iCal\Property\Event\RecurrenceRule();
        $recurrenceRule->setFreq(\Eluceo\iCal\Property\Event\RecurrenceRule::FREQ_WEEKLY);
        $recurrenceRule->setInterval(1);
        $vEvent->setRecurrenceRule($recurrenceRule);
        --------------------*/

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

        //return response()->download($storagePath);
        //return response()->download($storagePath, $filename, $headers);
       
        return response($start_date); 
    }
}

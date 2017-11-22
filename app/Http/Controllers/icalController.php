<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\task;
use DB;

class icalController extends Controller
{
    public function ical(Request $req) {


        $x = collect($req)->toJson();
        $data = json_decode($x);
        $myDate = $data->DateTime;
        $myTaskId = $data->taskId;
        $task = new task;
        $getTitle = $task->select('title')->where('id', $myTaskId)->get();
        $myTaskTitle = ($getTitle[0]->title);
        
        
        // set default timezone (PHP 5.4)
        date_default_timezone_set('asia/bangkok');
        // 1. Create new calendar
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        //for ($i = 0; $i <2; $i++){
            

        // 2. Create an event
        $vEvent = new \Eluceo\iCal\Component\Event();
        //$vEvent->setDtStart(new \DateTime('2012-11-11 13:00:00'));
        //$vEvent->setDtEnd(new \DateTime('2012-11-11 14:30:00'));
        $vEvent->setDtStart(new \DateTime($myDate));
        $vEvent->setDtEnd(new \DateTime($myDate));
        $vEvent->setSummary($myTaskTitle);
        //$vEvent->setSummary('test-ical');

        /* Set recurrence rule

        $recurrenceRule = new \Eluceo\iCal\Property\Event\RecurrenceRule();
        $recurrenceRule->setFreq(\Eluceo\iCal\Property\Event\RecurrenceRule::FREQ_WEEKLY);
        $recurrenceRule->setInterval(1);
        $vEvent->setRecurrenceRule($recurrenceRule);
        --------------------*/

        // Adding Timezone (optional)
        $vEvent->setUseTimezone(true);

        // 3. Add event to calendar
        
        $vCalendar->addComponent($vEvent);
        //}

        // 4. Set headers
        $headers = [
            'Content-type'        => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="cal.ics"',
        ];
        $contents = $vCalendar->render();
        
        //Save file
        $pathToFile = '/ical3.ics';
        
        //Storage::put($pathToFile, $contents);
        $files1 = public_path(). "/ical3.ics";

        download($files1, $contents, $headers)->deleteFileAfterSend(true);

       // 5. Output
        
        //
        //return response()->download($);
        //return response()->download($pathToFile);
        
        //return response()->download($pathToFile, $name, $headers);
        //return response()->download($pathToFile)->deleteFileAfterSend(true);
        
        //return Response::make($vCalendar->render());
        
        
        return response($pathToFile);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\task;
use DB;

class ical1Controller extends Controller
{
    public function ical() {

        $myObj = collect(['DateTime' => '2017-11-09 12:12:00', 'TaskId' => 3])->toJson();
        //echo '$myObj : ' . var_dump($myObj) .'<br>';
        $myData = json_decode($myObj);
        echo '$myData : ' . var_dump($myData) . '<br>';
        $myDate = $myData->DateTime;
        //echo '$myDate : ' . var_dump($myDate) . '<br>';
        $myTaskId = $myData->TaskId;
        //echo '$myDate : ' . var_dump($myTaskId) . '<br>';
        
        $task = new task;
        $getTitle = $task->select('title')->where('id', $myTaskId)->get('first');
        $myTaskTitle = ($getTitle[0]->title);

        
        
        // set default timezone (PHP 5.4)
        date_default_timezone_set('asia/bangkok');
        // 1. Create new calendar
        $vCalendar = new \Eluceo\iCal\Component\Calendar('www.example.com');

        
        // 2. Create an event
        $vEvent = new \Eluceo\iCal\Component\Event();
        //$vEvent->setDtStart(new \DateTime('2012-11-11 13:00:00'));
        //$vEvent->setDtEnd(new \DateTime('2012-11-11 14:30:00'));
        $vEvent->setDtStart(new \DateTime($myDate));
        $qw =   (new \DateTime($myDate));
        //print $qw;

        $discount_start_date = '03/27/2012 8:47';    
        $start_date = date('Y-m-d H:i:s', strtotime($discount_start_date));
        echo '<br>'.$start_date.'<br>';

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
        

        // 4. Set headers
        
        header('Content-Type: text/calendar; charset=utf-8');
       // header('Content-Disposition: attachment; filename="cal223.ics"');

       // 5. Output
       $yo = $vCalendar->render();
        //echo $vCalendar->render();
        echo $yo;

      //  return response()->download($vCalendar->render());
        
        //return response($req);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appoint;

class appointController extends Controller
{
    public function getappoint() {
        $appoint = new appoint;
        
        $data = $appoint->get();
        //DB::table('task')->join('appoint', 'task.id' , '=' , 'appoint.task_id')->select('task.title', 'appoint.date','appoint.id')->get();

        return response($data);
    }
}

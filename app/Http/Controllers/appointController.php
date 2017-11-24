<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appoint;
use DB;

class appointController extends Controller
{
    public function getappoint() {
        $appoint = new appoint;
        
        //$data = $appoint->get();
        $data = DB::table('task')->join('appoint', 'task.id' , '=' , 'appoint.task_id')->orderBy('appoint.id')->select('task.title', 'appoint.date','appoint.id')->get();

        return response($data);
    }
}

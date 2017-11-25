<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appoint;
use DB;

class appointController extends Controller
{
    public function getallappoint() {
        //$appoint = new appoint;
        
        $data = DB::table('task')->join('appoint', 'task.id', '=', 'appoint.task_id')
                                 ->orderBy('appoint.id')
                                 ->select('task.title', 'appoint.date', 'appoint.id')
                                 ->get();
        //DB::disconnect();
        return response($data);
    }
}

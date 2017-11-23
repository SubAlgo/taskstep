<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\appoint;

class appointController extends Controller
{
    public function getappoint() {
        $appoint = new appoint;
        
        $data = $appoint->get();

        return response($data);
    }
}

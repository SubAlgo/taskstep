<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testController extends Controller
{
    public function test() {

        $in1 =  json_encode(['a' => 1, 'b' => 2, 'c' => 3]);
        $in2 = collect(['tai','ww','ee'])->toJson();
        //"step":["ta1","ta2","ta3","ta4"]
        //collect("task":"test13","step":["go1","go2","go3","go4"])->tojson();
        echo var_dump($in1);
        echo ('<br>');
        echo  var_dump($in2);
        echo ('<br>');
        $in3 = json_decode($in1);
        echo var_dump($in3);
        echo ('<br>');
        echo $in3->b;
        echo ('<br>');

        $in4 = json_decode($in2);
        echo var_dump($in4);
        echo ('<br>');
        echo $in4[0];
        echo ('<br>');
        echo $in4[1];
        //echo $q;
        //echo $in2[0];
    }
}

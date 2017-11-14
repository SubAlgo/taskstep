<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class testController extends Controller
{
    public function test() {

        $data = collect(['task1','task2','task3','task4'])->toJson();
        echo var_dump($data);
        echo '<br>';
        $dataDecode = json_decode($data);
        echo var_dump($dataDecode);
        echo '<br>';
        echo $dataDecode[1];

        foreach($dataDecode as $val) {
            echo "<br>";
            echo "data in foreach : $val";
        }
        






        /*
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
        echo $in4[2];
        echo '<br>';
        echo "ecc $in4[0]";
        //echo $q;
        //echo $in2[0];
        */
        
    }
}

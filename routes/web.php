<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/task', function () {
    return view('task');
});

Route::post('/task', function (Request $res) {
    //$t = JSON.parse($res);
    //$returnValue = json_decode('{"task":"qwq","step":["1","2"]}');
    //$returnValue = json_decode($res);
    //$te = json_encode($returnValue);



    $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

   $r = json_encode($arr);
   

   if(Request::ajax()){
    return Response::json(Request::all());
 }
   //return Response::json($r);
   
    //return Response::json($res::all());
   /*
    if(Request::ajax()){
        return Response::json(Request::all());
     }
     */
});

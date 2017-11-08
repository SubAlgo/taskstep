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

    $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

   $r = json_encode($arr);
   return Response::json($r);
   
    //return Response::json($res::all());
   /*
    if(Request::ajax()){
        return Response::json(Request::all());
     }
     */
});

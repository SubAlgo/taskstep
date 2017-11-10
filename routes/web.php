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

Route::post('/task', function (Request $req) {

    //สร้าง object จาก Model task
    $task = new App\task;
    $step = new App\step;

    //สร้างตัวแปร cTask เพื่อเก็บค่า task ที่ถูกส่งมาจาก View
    $cTask = $req::get('task');

    //นำตัวแปร cTask มากำหนดค่าให้กับ Task Title
    $task->title = $cTask;
    //บันทึกลง DataBase Table Task
    //---- $task->save();
    //$myJson = $req->input('task');

    $cStep = $req::get('step');
    /*
    $json_array  = json_decode($cStep, true);
    $x  = count($json_array);
    $i = 1;

    foreach($json_array as $val) {
        $step->no = $i;
        $i++;
        $step->title = $val;
        $step->task_id = 1;
        $step->save();
    }
    */
    //return Response::json(Request::all());
    return Response::json($req::get('task'));

});

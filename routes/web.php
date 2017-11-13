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
Route::get('/test', 'testController@test'); 

Route::get('/', function () {
    return view('index');
});

Route::get('/task', function () {
    return view('task');
});

Route::post('/task', function (Request $req) {

    //-------- Save TASK ---------
    //สร้าง object จาก Model task
    $task = new App\task;

    //สร้างตัวแปร cTask เพื่อเก็บค่า task ที่ถูกส่งมาจาก View
    $cTask = $req::get('task');

    //นำตัวแปร cTask มากำหนดค่าให้กับ Task Title
    $task->title = $cTask;
    //บันทึกลง DataBase Table Task
    //---$task->save();
    //$myJson = $req->input('task');

    //-------- Save STEP ---------
    $step = new App\step;

    $da1 = $req::all();
    $c =$da1['task'];
    $d = $da1['step'];
    //$d1 = $d->toArray();
    $dd = collect($d)->toJson();
    
    
    $i =1;
    
   foreach($d as $val) {
       $step->no = $i;
       $i++;
       $step->title = $val;
       $step->task_id = 2;
       //$step->save();

   }
        
    /*
    use App\Flight;
    $flights = App\Flight::all();
    */

    
    //return Response($req::all());
    return Response($req::get('step'));
    //return response()->json($d1);

    //return Response($req::get('step'));
    
    //return Response::json(Request::all());
    //return Response::json($cStep);
    //return response()->json($cStep);

});

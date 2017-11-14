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

    
    //สร้าง object จาก Model task
    $task = new App\task;
    $step = new App\step;

    //-------- Save TASK ---------
    //สร้างตัวแปร cTask เพื่อเก็บค่า task ที่ถูกส่งมาจาก View
    $cTask = $req::get('task');
    //นำตัวแปร cTask มากำหนดค่าให้กับ Task Title
    $task->title = $cTask;
    //บันทึกลง DataBase Table Task
    $task->save();

    //-------- Save STEP ---------
    //เอาข้อมูล step ที่รับมาแปลงเป็น Json
    $stepData = collect($req::get('step'))->toJson();
    //decode ข้อมูลเพื่อให้สามารถเอาไปใช้ใน foreach ได้
    $stepDecode = json_decode($stepData);

    //กำหนดค่า taskid = id ของ taskที่ถูกสร้างล่าสุด
    $task_data = $task->get()->last();
    $task_id = $task_data->id;


    $i = 0;
    foreach($stepDecode as $val) {
        DB::table('step')->insert(
        ['no' => $i+1,
        'title' => $stepDecode[$i],
        'task_id' => $task_id
        ]);
        $i++;
    }

        
    /*
    use App\Flight;
    $flights = App\Flight::all();
    */
    return Response($i);
    
    //return Response($req::all());
    //return Response($req::get('step'));
    //return response()->json($d1);

    //return Response($req::get('step'));
    
    //return Response::json(Request::all());
    //return Response::json($cStep);
    //return response()->json($cStep);

});

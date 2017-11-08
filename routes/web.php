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
    //$myArr = array("John", "Mary", "Peter", "Sally");
    //$myJSON = json_encode($myArr);

    $data = $req->task;
    

    //return response()->json(['response' => 'This is post method']); 
    
    //return Response::json($data);
    return response()->json([
    'name' => 'Abigail',
    'state' => 'CA'
]);
    //return response()->json($data);
});

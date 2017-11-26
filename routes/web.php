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

Route::get('/ical', 'icalController@ical'); 
Route::post('/ical', 'icalController@ical'); 
Route::get('/ical1', 'ical1Controller@ical');

Route::get('/ical/createmulti', 'icalController@multiCreateCsi');

Route::get('/getappoint', 'appointController@getallappoint');

Route::get('/', function () {
    return view('index');
});

Route::get('/task', function () {
    return view('task');
});



Route::get('/createics', function () {
    return view('createics');
});

Route::post('/task', 'TaskStepController@createTaskStep');

Route::post('/setappoint', 'TaskStepController@createAppoint');

Route::get('/gettask', 'TaskStepController@gettask');

Route::post('/gettasktitle' , 'TaskStepController@getTaskTitle');

Route::get('/calendar', function () {
    return view('calendar');
});

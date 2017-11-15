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

Route::post('/task', 'TaskStepController@createTaskStep');

Route::get('/calendar', function () {
    return view('calendar');
});

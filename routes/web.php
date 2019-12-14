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
    return view('welcome');
});

Route::resource('/employees', 'EmployeeController');
Route::resource('/students', 'StudentController');

Route::post('/students', 'StudentController@store')->name('student.store');
Route::put('/studentUpdate/{id}', 'StudentController@update')->name('student.update');

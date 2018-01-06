<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('courses', 'HomeController@courses')->name('courses');

Route::post('course', 'HomeController@create')->name('create');

Route::put('course/{course}', 'HomeController@edit')->name('edit');

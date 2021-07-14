<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//登陆，注销
Route::get('/login','UserController@login');
Route::post('/login','UserController@Dologin');
Route::get('/logout','UserController@logout');



//后台界面
Route::controller('/adm/user','UserController');
Route::controller('/adm/expert','ExpertController');
Route::controller('/adm/live','LiveController');
Route::get('/adm','UserController@adminIndex');



//前台
Route::controller('/front','FrontController');
Route::get('/','FrontController@Index');
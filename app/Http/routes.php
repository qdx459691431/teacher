<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
       后台登陆注册
*/
Route::get('/', 'admin\LoginController@index');
Route::post('log', 'admin\LoginController@info');
Route::get('demo', 'admin\LoginController@login');
Route::get('tuichu', 'admin\LoginController@logout');
Route::post('zhuce', 'admin\LoginController@add');

/*
       科目管理
*/
 Route::get('bookadd', 'admin\SubjectController@adds');

 Route::get('regs', 'admin\SubjectController@cha');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

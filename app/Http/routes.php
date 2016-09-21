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

Route::any('/', 'admin\LoginController@index');
//后台学校路由
Route::any('schooladd', 'admin\SchoolController@schooladd');
Route::any('schooladds', 'admin\SchoolController@schooladds');
Route::any('schoollist', 'admin\SchoolController@schoollist');
Route::any('schooldel', 'admin\SchoolController@schooldel');
Route::any('schoolupdate', 'admin\SchoolController@schoolupdate');
Route::any('schoolnewup', 'admin\SchoolController@schoolnewup');
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

// Route::group(['middleware' => ['web']], function () {
//     //
// });

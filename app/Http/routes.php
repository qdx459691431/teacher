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
       目录管理
*/
 Route::get('bookadd', 'admin\SubjectController@adds');
 Route::get('regs', 'admin\SubjectController@cha');
 Route::post('jia', 'admin\SubjectController@jias');
 Route::get('booklist', 'admin\SubjectController@lists');
Route::get('bookdel', 'admin\SubjectController@del');
Route::get('dataadd', 'admin\SubjectController@tian');
Route::post('ad', 'admin\SubjectController@ads');

//后台学校路由
Route::any('schooladd', 'admin\SchoolController@schooladd');
Route::any('schooladds', 'admin\SchoolController@schooladds');
Route::any('schoollist', 'admin\SchoolController@schoollist');
Route::any('schooldel', 'admin\SchoolController@schooldel');
Route::any('schoolupdate', 'admin\SchoolController@schoolupdate');
Route::any('schoolnewup', 'admin\SchoolController@schoolnewup');

Route::get('courseadd', 'admin\CourseController@insert');
Route::post('add', 'admin\CourseController@add');
Route::get('courselist', 'admin\CourseController@show');
Route::get('course_del', 'admin\CourseController@del');
Route::get('coursetype', 'admin\CourseController@type');
Route::post('type_add', 'admin\CourseController@type_add');

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

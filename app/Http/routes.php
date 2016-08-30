<?php

// 认证路由
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

//用户主界面
Route::get('/', 'DashboardController@index');

//章节练习
Route::get('/chapter_practice', 'DashboardController@chapter_practice');
//大题练习
Route::get('/dati_practice', 'DashboardController@dati_practice');
//考前冲刺
Route::get('/sprint_test', 'DashboardController@sprint_test');
//视频
Route::get('/video', 'DashboardController@video');
//考试大纲
Route::get('/test_syllabus', 'DashboardController@test_syllabus');
//帐号管理
Route::get('/accounts_manage', 'DashboardController@accounts_manage');
//常见问题
Route::get('/question', 'DashboardController@question');


//开始考试
Route::get('/start_exam', 'TestController@start_exam');
//考试数据
Route::get('/exam', 'TestController@examDate');






// ---管理员管理
// 用户管理

// 属于 `Owner` 用户组的人, 才能访问 `admin/advanced*` 开头的链接
Entrust::routeNeedsRole( 'admin/*', 'admin' );

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function ($router) {

    //用户管理
    require( __DIR__ . '/Route/UserManageRoute.php');

    //考题管理
    require( __DIR__ . '/Route/QuestionManageRoute.php');

});

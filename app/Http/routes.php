<?php

// 认证路由...
Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

//模拟考试
Route::get('/dashboard', 'DashboardController@index');

//考试数据
Route::get('/examtest', 'DashboardController@examDate');

//章节练习
Route::get('/chapter_practice', function () {

    return view("before.chapter_practice");

});

//大题练习
Route::get('/dati_practice', function () {

    return view("before.dati_practice");

});

//考前冲刺
Route::get('/sprint_test', function () {

    return view("before.sprint_test");

});

//视频
Route::get('/video', function () {

    return view("before.video");

});

//考试大纲
Route::get('/test_syllabus', function () {

    return view("before.test_syllabus");

});

//帐号管理
Route::get('/accounts_manage', function () {

    return view("before.accounts_manage");

});

//常见问题
Route::get('/question', function () {

    return view("before.question");

});


//开始考试
Route::get('/start_exam', function () {

    return view("before.start_exam");

});

//考试
Route::get('/exam', function () {

    return view("before.exam");

});

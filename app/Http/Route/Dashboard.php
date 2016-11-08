<?php

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

<?php

//开始考试
Route::get('/start_exam', 'ExamController@start_exam');
//考试数据
Route::get('/exam', 'ExamController@examDate');
//交卷
Route::post('/handPaper', 'ExamController@handPaper');

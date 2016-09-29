<?php

//小题
$router->get('questionManage/table', 'QuestionManageController@table');
$router->Post('questionManage/destroy_many', 'QuestionManageController@destroy_many');
$router->resource('questionManage', 'QuestionManageController', ['except' => ['show']]);

//大题
$router->get('questionDatiManage/table', 'QuestionDatiManageController@table');
$router->Post('questionDatiManage/destroy_many', 'QuestionDatiManageController@destroy_many');
$router->resource('questionDatiManage', 'QuestionDatiManageController', ['except' => ['show']]);

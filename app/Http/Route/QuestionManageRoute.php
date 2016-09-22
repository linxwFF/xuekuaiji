<?php

$router->get('questionManage/table', 'QuestionManageController@table');
$router->get('questionManage/createDati', 'QuestionManageController@createDati');
$router->Post('questionManage/storeDati', 'QuestionManageController@storeDati');
$router->Post('questionManage/destroy_many', 'QuestionManageController@destroy_many');
$router->resource('questionManage', 'QuestionManageController');

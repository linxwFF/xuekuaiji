<?php

$router->get('questionManage/table', 'QuestionManageController@table');
$router->get('questionManage/createDati', 'QuestionManageController@createDati');
$router->Post('questionManage/storeDati', 'QuestionManageController@storeDati');
$router->resource('questionManage', 'QuestionManageController');

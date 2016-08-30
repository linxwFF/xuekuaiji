<?php

$router->get('questionManage/table', 'QuestionManageController@table');
$router->resource('questionManage', 'QuestionManageController');

<?php

//用户管理
$router->get('userManage/table', 'UserManageController@table');
$router->Post('userManage/destroy_many', 'UserManageController@destroy_many');
$router->resource('userManage', 'UserManageController', ['except' => ['show', 'create', 'store']]);

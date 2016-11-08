<?php

// 认证路由
require(__DIR__ . '/Route/Auth.php');



//控制台
require(__DIR__ . '/Route/Dashboard.php');
//考试
require(__DIR__ . '/Route/ExamRoute.php');


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

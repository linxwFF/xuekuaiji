<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Eloquent\Repository;
use App\Models\User;

class UserRepository extends Repository
{
	// 实现抽象类的方法  返回一个UserModel对象实例
    public function model()
    {
        return User::class;
    }

    // 以下可以重新基类方法

}

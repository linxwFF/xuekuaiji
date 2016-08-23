<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * User表的数据填充
     * @return void
     */
    public function run()
    {

        //admin角色
        $adminRole = Role::where('name', 'admin')->first();
        //user 角色
        $userRole = Role::where('name', 'user')->first();

        //admin 账号
        $admin_user_fileds = array(
            'name'  =>  'admin',
            'email' =>  '874226876@qq.com',
            'password' => bcrypt('admin')
        );
        //创建管理员帐号并且赋予admin 权限  --单个对象不能使用each 5.1
        $admin_user = factory('App\Models\User')->create($admin_user_fileds)->attachRole($adminRole);

        //普通用户
        $comm_users_fileds = array(
            'password' => bcrypt('123456')
        );
        //创建普通用户帐号并且赋予user 权限
        $comm_users = factory('App\Models\User', 3)->create($comm_users_fileds)->each(
            function($u) use ($userRole){
                $u->attachRole($userRole);
        });
    }
}

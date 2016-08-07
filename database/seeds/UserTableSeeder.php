<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * User表的数据填充
     * @return void
     */
    public function run()
    {
        //admin 账号
        $admin_user_fileds = array(
            'name'  =>  'admin',
            'email' =>  '874226876@qq.com',
            'password' => bcrypt('admin')
        );
        $admin_user = factory('App\Models\User')->create($admin_user_fileds);

        //普通用户
        $comm_users_fileds = array(
            'password' => bcrypt('admin')
        );
        $comm_users = factory('App\Models\User',3)->create($comm_users_fileds);
    }
}

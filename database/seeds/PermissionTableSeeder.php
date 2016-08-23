<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new Permission;
        $permission->name = 'login admin';
        $permission->display_name = '登录后台';
        $permission->description = '登录后台';
        $permission->save();

    }
}

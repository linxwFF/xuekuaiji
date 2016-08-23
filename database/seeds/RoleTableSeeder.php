<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role;
        $admin->name = 'admin';
        $admin->display_name = 'admin';
        $admin->description = 'admin';
        $admin->save();

        $owner = new Role;
        $owner->name = 'user';
        $owner->display_name = 'user';
        $owner->description = 'user';
        $owner->save();

        //所有权限
        $allpermission = array_column(Permission::all()->toArray(), 'id');
        //赋予多个权限
        $admin->perms()->sync($allpermission);

        //登录后台
        $loginAdmin  = Permission::where('display_name', '登录后台')->first();
        //赋予权限
        $owner->attachPermission($loginAdmin);
    }
}

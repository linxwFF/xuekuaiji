<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // 只在首次运行 Seeder 的时候添加初始用户
        $first_init = User::find(1) ? false : true;
         if ($first_init) {
            $this->call(PermissionTableSeeder::class);
            $this->call(RoleTableSeeder::class);
            $this->call(UserTableSeeder::class);
            $this->command->info('init UserInfo success!');
        }

        $this->call('DictTableSeeder');
        $this->command->info('DictTableSeeder success!');

        Model::reguard();
    }
}

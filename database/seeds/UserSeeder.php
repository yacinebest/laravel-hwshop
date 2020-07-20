<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $role_admin = Role::whereType('ADMIN')->first();
        $role_user = Role::whereType('USER')->first();
        factory(\App\Models\User::class)->create(['email'=>'admin1@gmail.com','username'=>'admin1',
                                                    'firstname'=>'karim','lastname'=>'bet','role_id'=>$role_admin->id]);

        factory(\App\Models\User::class)->create(['email'=>'admin2@gmail.com','username'=>'admin2',
                                                    'firstname'=>'zaki','lastname'=>'det','role_id'=>$role_admin->id]);

        factory(\App\Models\User::class,40)->create(['role_id'=>$role_user->id]);
    }
}

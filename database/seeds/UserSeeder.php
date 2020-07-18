<?php

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

        factory(\App\Models\User::class)->create(['email'=>'admin1@gmail.com','username'=>'admin1','first_name'=>'karim','last_name'=>'bet']);
        factory(\App\Models\User::class)->create(['email'=>'admin2@gmail.com','username'=>'admin2','first_name'=>'zaki','last_name'=>'det']);
    }
}

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

        factory(\App\Models\User::class)->create(['email'=>'test1@gmail.com','username'=>'test1','first_name'=>'karim','last_name'=>'bet']);
        factory(\App\Models\User::class)->create(['email'=>'test2@gmail.com','username'=>'test2','first_name'=>'karim','last_name'=>'bet']);
    }
}

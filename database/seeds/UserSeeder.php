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

        factory(\App\Models\User::class)->create(['email'=>'admin1@gmail.com','username'=>'admin1','firstname'=>'karim','lastname'=>'bet']);
        factory(\App\Models\User::class)->create(['email'=>'admin2@gmail.com','username'=>'admin2','firstname'=>'zaki','lastname'=>'det']);
    }
}

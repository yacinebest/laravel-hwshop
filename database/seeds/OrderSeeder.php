<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();

        $role_user = Role::whereType('USER')->first();

        foreach (User::where('role_id',$role_user->id)->get()->take(6) as $user) {
            factory(\App\Models\Order::class)->create(['user_id'=>$user->id]);
        }
    }
}

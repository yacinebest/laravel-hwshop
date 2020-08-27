<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Order;
use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' =>  function(){
            return factory(\App\Models\User::class)->create(['role_id'=>
                ( (Role::whereType('USER')->first()) ? Role::whereType('USER')->first()->id : Role::create(['type'=>'USER'])->id ) ]);
        },
        // 'admin_id' => function(){
        //     return factory(\App\Models\User::class)->create(['role_id'=>Role::whereType('ADMIN')->first()->id])->id;
        // },
        'order_date' => now()->format('Y-m-d H:m:s'),
    ];
});

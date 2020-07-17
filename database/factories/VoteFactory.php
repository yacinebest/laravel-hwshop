<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Role;
use App\Models\Vote;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    return [
        'type' => $faker->randomElement(['DOWN','UP']),
        'user_id' =>  function(){
            return factory(\App\Models\User::class)->create(['role_id'=>
                ( (Role::whereType('USER')->first()) ? Role::whereType('USER')->first()->id : Role::create(['type'=>'USER'])->id ) ]);
        },
        'voteable_type' => $faker->randomElement( [
            App\Models\Product::class,
            App\Models\Comment::class,
        ]),
        'voteable_id' =>function(array $note){
            return factory($note['voteable_type'])->create()->id;
        },
    ];
});

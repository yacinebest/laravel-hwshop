<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'product_id' => function(){
            return factory(\App\Models\Product::class)->create()->id;
        },
        'user_id' => function(){
            return factory(\App\Models\User::class)->create()->id;
        },
        'body' => $faker->sentence(30),
    ];
});

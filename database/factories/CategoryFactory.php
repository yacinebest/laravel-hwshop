<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => "Category ". $faker->numberBetween(),
        'parent_id' => $faker->randomElement([function(){
            return factory(\App\Models\Category::class)->create()->id;
        },null]) ,
    ];
});

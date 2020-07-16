<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence(30),
        'price' => $faker->randomNumber(5),
        'updated_price_at' => now()->format('Y-m-d H:m:s'),
        'copy_number' => $faker->randomNumber(3),
        'view' => $faker->randomNumber(5),
        'category_id'=> function(){
            return factory(\App\Models\Category::class)->create()->id;
        }
    ];
});

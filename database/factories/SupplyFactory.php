<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Supply;
use Faker\Generator as Faker;

$factory->define(Supply::class, function (Faker $faker) {
    return [
          'product_id'=> function(){
            return factory(\App\Models\Product::class)->create()->id;
            },
            'admission_price' => $faker->randomNumber(5),
            'supply_date' => now()->format('Y-m-d H:m:s'),
            'quantity' => $faker->randomNumber(3),
    ];
});
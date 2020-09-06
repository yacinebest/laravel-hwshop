<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Delivery;
use Faker\Generator as Faker;

$factory->define(Delivery::class, function (Faker $faker) {
    return [
        'delivery_society'=>'TEX',
        'phone_number'=>'+213000000000',
        'price'=>1000.00
    ];
});

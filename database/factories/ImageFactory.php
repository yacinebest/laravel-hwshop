<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'file' => $faker->name . '.jpg',
        'imageable_type' => $faker->randomElement( [
            App\Models\User::class,
            App\Models\Category::class,
            App\Models\Product::class,
            App\Models\Brand::class,
        ]),
        'imageable_id' =>function(array $note){
            return factory($note['imageable_type'])->create()->id;
        },
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Image;
use Faker\Generator as Faker;

function random_pic($dir='public/storage/uploads/products')
{
    $files = glob($dir . '/*.*');
    $file = array_rand($files);
    return last( explode('/', $files[$file]) );
}

$factory->define(Image::class, function (Faker $faker) {
    return [
        'file' => random_pic('public/storage/uploads/products'),
        'imageable_type' => $faker->randomElement( [
            App\Models\Category::class,
            App\Models\Product::class,
        ]),
        'imageable_id' =>function(array $note){
            return factory($note['imageable_type'])->create()->id;
        },
    ];
});

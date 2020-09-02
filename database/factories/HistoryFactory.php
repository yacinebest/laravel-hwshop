<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\History;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(History::class, function (Faker $faker) {
    return [
        'product_id'=> function(){
            return factory(\App\Models\Product::class)->create();
        },
        'quantity' => function(array $element) use ($faker){
            return $faker->randomNumber(5);
            // return Product::findOrFail($element['product_id'])->quantity;
        },
        'supply_id'=> function(array $element){
            return factory(\App\Models\Supply::class)->
                        create([
                            'product_id'=>$element['product_id'],
                            // 'product_id'=>$element['product_id'],
                            'quantity'=>$element['quantity']
                        ])->id;
        },
        'selling_price' => function(array $element){
            return Product::findOrFail($element['product_id'])->price;
        },
        'started_at' => now()->format('Y-m-d H:m:s')

    ];
});

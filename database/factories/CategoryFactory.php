<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Category;
use Faker\Generator as Faker;


$element=null;
$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => "Category ". $faker->numberBetween(),
        'parent_id' => $faker->randomElement([$element = function(){
            return factory(\App\Models\Category::class)->create()->id;
        },null]) ,
        // 'level' => ($element ? $element->level +1 : 1),
        'level' => function(array $array){
            return $array['parent_id'] ? Category::findOrFail($array['parent_id'])->level + 1 : 1 ;
        },
    ];
});

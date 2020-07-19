<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        // 'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('123456789'),
        'remember_token' => Str::random(10),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'username' => $faker->userName,
        'address' => $faker->address,
        'birth_date' => $faker->dateTimeBetween('01-01-1970','31-12-2008')->format('Y-m-d'),
        'gender' => $faker->randomElement( ['MALE','FEMALE']),
        'country' => $faker->country,
        'phone_number' => $faker->e164PhoneNumber,
        'role_id' =>  Role::whereType( $faker->randomElement( ['USER','ADMIN'])  )->first()->id
    ];
});

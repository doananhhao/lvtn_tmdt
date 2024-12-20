<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'), // secret
        'remember_token' => str_random(10),
        'sdt' => $faker->e164PhoneNumber,
        'nam' => rand(0,1) == 1,
        'diachi' => $faker->address,
        'avatar' => $faker->uuid.'.jpg',
        'trangthai' => rand(0,1) == 1,
    ];
});

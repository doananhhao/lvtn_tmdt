<?php

use Faker\Generator as Faker;

$factory->define(App\Models\HoaDon::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'diachi' => $faker->streetAddress,
        'sdt' => $faker->e164PhoneNumber,
        'mota' => ''
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\BinhLuan::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'sanpham_id' => App\Models\SanPham::inRandomOrder()->first()->id,
        'noidung' => $faker->realText($maxNbChars = 110, $indexSize = 2)
    ];
});

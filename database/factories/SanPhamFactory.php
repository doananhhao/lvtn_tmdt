<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SanPham::class, function (Faker $faker) {
    return [
        'tensanpham' => $faker->name,
        'gia' => rand(1,100)*1000,
        'soluong' => rand(1,50),
        'mota' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'hinhanh' => 'abc.jpg',
        'loaisp_id' => App\Models\LoaiSP::inRandomOrder()->first()->id,
        'nhacungcap_id' => App\Models\NhaCungCap::inRandomOrder()->first()->id,
    ];
});

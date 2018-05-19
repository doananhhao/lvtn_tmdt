<?php

use Faker\Generator as Faker;

//Thêm ChiTietKhuyenMai từ model LoaiKhuyenMai để tự sinh khóa ngoại
$factory->define(App\Models\ChiTietKhuyenMai::class, function (Faker $faker) {
    return [
        'sanpham_id' => App\Models\SanPham::inRandomOrder()->first()->id,
        'giamgia' => rand(1,10)*0.05,
        'ngaybd' => date('Y-m-d H:i:s'),
        'ngayketthuc' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 3 days'))
    ];
});

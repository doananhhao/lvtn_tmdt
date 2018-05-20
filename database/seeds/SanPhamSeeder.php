<?php

use Illuminate\Database\Seeder;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'tensanpham' => 'DEMO 5',
                'gia' => 10000,
                'soluong' => 3,
                'mota' => '',
                'hinhanh' => 'abc.jpg',
                'loaisp_id' => App\Models\LoaiSP::inRandomOrder()->first()->id,
                'nhacungcap_id' => App\Models\NhaCungCap::inRandomOrder()->first()->id,
            ],
            [
                'tensanpham' => 'DEMO 6',
                'gia' => 13000,
                'soluong' => 7,
                'mota' => '',
                'hinhanh' => 'abc.jpg',
                'loaisp_id' => App\Models\LoaiSP::inRandomOrder()->first()->id,
                'nhacungcap_id' => App\Models\NhaCungCap::inRandomOrder()->first()->id,
            ],
            [
                'tensanpham' => 'DEMO 7',
                'gia' => 21000,
                'soluong' => 1,
                'mota' => '',
                'hinhanh' => 'abc.jpg',
                'loaisp_id' => App\Models\LoaiSP::inRandomOrder()->first()->id,
                'nhacungcap_id' => App\Models\NhaCungCap::inRandomOrder()->first()->id,
            ],
            [
                'tensanpham' => 'DEMO 8',
                'gia' => 15000,
                'soluong' => 5,
                'mota' => '',
                'hinhanh' => 'abc.jpg',
                'loaisp_id' => App\Models\LoaiSP::inRandomOrder()->first()->id,
                'nhacungcap_id' => App\Models\NhaCungCap::inRandomOrder()->first()->id,
            ],
        ];

        foreach ($data as $v){
            $loaisp = App\Models\SanPham::create($v);
        }
    }
}

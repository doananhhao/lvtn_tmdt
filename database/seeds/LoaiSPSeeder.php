<?php

use Illuminate\Database\Seeder;

class LoaiSPSeeder extends Seeder
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
                'tenloai' => 'Điện Thoại'
            ],
            [
                'tenloai' => 'Máy Tính'
            ],
            [
                'tenloai' => 'Quần'
            ],
            [
                'tenloai' => 'Áo'
            ]
        ];

        foreach ($data as $v){
            $loaisp = App\Models\LoaiSP::create($v);
        }
    }
}

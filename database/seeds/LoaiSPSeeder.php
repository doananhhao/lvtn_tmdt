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
                'tenloai' => 'Điện Thoại',
                'classfaicon' => 'icon fa fa-desktop fa-fw',
            ],
            [
                'tenloai' => 'Máy Tính',
                'classfaicon' => 'icon fa fa-desktop fa-fw',
            ],
            [
                'tenloai' => 'Quần',
                'classfaicon' => 'icon fa fa-desktop fa-fw',
            ],
            [
                'tenloai' => 'Áo',
                'classfaicon' => 'icon fa fa-desktop fa-fw',
            ]
        ];

        foreach ($data as $v){
            $loaisp = App\Models\LoaiSP::create($v);
        }
    }
}

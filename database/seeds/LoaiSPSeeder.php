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
                'tenloai' => 'TV & điện gia dụng',
                'classfaicon' => 'icon fa fa-desktop fa-fw',
            ],
            [
                'tenloai' => 'Thiết bị điện tử',
                'classfaicon' => 'icon fa fa-mobile fa-fw',
            ],
            [
                'tenloai' => 'Phụ kiện điện tử',
                'classfaicon' => 'icon fa fa-cog fa-fw',
            ],
            [
                'tenloai' => 'Gia dụng & Đời sống',
                'classfaicon' => 'icon fa fa-heart-o fa-fw',
            ],
            [
                'tenloai' => 'Mẹ, Bé & Đồ chơi',
                'classfaicon' => 'icon fa fa-home fa-fw',
            ],
            [
                'tenloai' => 'Sức khỏe & làm đẹp',
                'classfaicon' => 'icon fa fa-gift fa-fw',
            ],
            [
                'tenloai' => 'Thời trang',
                'classfaicon' => 'icon fa fa-group fa-fw',
            ],
            [
                'tenloai' => 'Thể thao & Du lịch',
                'classfaicon' => 'icon fa fa-plane fa-fw',
            ],
            [
                'tenloai' => 'Tạp hóa',
                'classfaicon' => 'icon fa fa-thumbs-o-up fa-fw',
            ],
            [
                'tenloai' => 'Khác',
                'classfaicon' => 'icon fa fa-navicon fa-fw',
            ]
        ];
        $data2 = array_reverse($data);
        foreach ($data2 as $v){
            $loaisp = App\Models\LoaiSP::create($v);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class KhuyenMaiSeeder extends Seeder
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
                'tenkhuyenmai' => 'Khuyến Mãi Noel',
                'mota' => ''
            ],
            [
                'tenkhuyenmai' => 'Khuyến Mãi Mùa Hè',
                'mota' => ''
            ],
        ];

        foreach ($data as $v){
            $loaisp = App\Models\LoaiKhuyenMai::create($v);
        }
    }
}

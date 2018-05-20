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
            [
                'tenkhuyenmai' => 'Khuyến Mãi Làm LVTN',
                'mota' => ''
            ],
        ];

        foreach ($data as $v){
            $loaikm = App\Models\LoaiKhuyenMai::create($v);
            $sp = App\Models\SanPham::select('id')->inRandomOrder()->limit(5)->get()->toArray();

            if (count($sp) < 5)
                $n = rand(0, count($sp) - 2);
            else
                $n = rand(0, 3);
            
            for ($i = 0; $i <= $n; $i++)
                $loaikm->ChiTietKhuyenMai()->create([
                    'sanpham_id' => $sp[$i]['id'],
                    'giamgia' => rand(1,10)*0.05,
                    'ngaybd' => date('Y-m-d H:i:s'),
                    'ngayketthuc' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 3 days'))
                ]);
        }
    }
}

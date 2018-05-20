<?php

use Illuminate\Database\Seeder;
use App\Models\SanPham;

class HoaDonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\HoaDon::class, 15)->create()->each(function ($hd) {
            $ds_id_sp = SanPham::select('id')->get()->toArray();
            if (count($ds_id_sp) < 6)
                $n = rand(0, count($ds_id_sp)-1); //số lần thêm sp vào
            else
                $n = rand(0, 5);
            shuffle($ds_id_sp);
            for ($i=0; $i<=$n; $i++)
                $hd->ChiTietHoaDon()->create([
                    'sanpham_id' => $ds_id_sp[$i]['id'],
                    'loaikhuyenmai_id' => null,
                    'soluong' => rand(1, 5),
                    'gia' => SanPham::find($ds_id_sp[$i]['id'])->gia,
                ]);
        });
    }
}

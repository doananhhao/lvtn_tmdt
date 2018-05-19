<?php

use Illuminate\Database\Seeder;

class ChiTietKhuyenMaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loaiKM = App\Models\LoaiKhuyenMai::all();

        foreach ($loaiKM as $km){
            for ($i = 0; $i < 2; $i++)
                $km->ChiTietKhuyenMai()->save(factory(App\Models\ChiTietKhuyenMai::class)->make());
        }
    }
}

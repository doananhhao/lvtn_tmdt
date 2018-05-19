<?php

use Illuminate\Database\Seeder;

class LoaiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loaiuser = array(
            array(
                'tenloai' => 'Quản trị viên'
            ),
            array(
                'tenloai' => 'Nhân viên'
            ),
            array(
                'tenloai' => 'Người dùng'
            ),
        );

        foreach ($loaiuser as $v){
            $loai = new App\Models\LoaiUser();
            $loai->tenloai = $v['tenloai'];
            $loai->save();
        }
    }
}

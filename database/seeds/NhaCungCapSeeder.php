<?php

use Illuminate\Database\Seeder;

class NhaCungCapSeeder extends Seeder
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
                'ten' => 'Khác',
                'diachi' => '',
                'sdt' => ''
            ]
        ];

        foreach ($data as $v){
            $loaisp = App\Models\NhaCungCap::create($v);
        }
    }
}

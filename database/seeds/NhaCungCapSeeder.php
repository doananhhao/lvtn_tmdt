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
                'ten' => 'Samsung',
                'diachi' => 'TP HCM',
                'sdt' => '0123456789'
            ],
            [
                'ten' => 'Apple',
                'diachi' => 'TP HCM',
                'sdt' => '0123456789'
            ],
            [
                'ten' => 'Blue Exchange',
                'diachi' => 'TP HCM',
                'sdt' => '0123456789'
            ],
            [
                'ten' => 'Nike',
                'diachi' => 'TP HCM',
                'sdt' => '0123456789'
            ]
        ];

        foreach ($data as $v){
            $loaisp = App\Models\NhaCungCap::create($v);
        }
    }
}

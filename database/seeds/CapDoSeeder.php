<?php

use Illuminate\Database\Seeder;

class CapDoSeeder extends Seeder
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
                'capdo' => 'Cấp 1',
                'diem' => 0,
            ],
            [
                'capdo' => 'Cấp 2',
                'diem' => 5000000,
            ],
            [
                'capdo' => 'Đại lý cấp 1',
                'diem' => 15000000,
                'chietkhau' => 0.1
            ],
            [
                'capdo' => 'Đại lý cấp 2',
                'diem' => 40000000,
                'chietkhau' => 0.15
            ]
        ];

        foreach ($data as $v){
            $loaisp = App\Models\CapDo::create($v);
        }
    }
}

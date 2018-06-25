<?php

use Illuminate\Database\Seeder;

class ChucVuSeeder extends Seeder
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
                'ten' => 'Trưởng phòng'
            ],
            [
                'ten' => 'Nhân viên'
            ]
        ];

        foreach ($data as $v){
            $cv = App\Models\ChucVu::create($v);
        }
    }
}

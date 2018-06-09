<?php

use Illuminate\Database\Seeder;

class PhongBanSeeder extends Seeder
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
                'ten' => 'Phòng kiểm tra'
            ],
            [
                'ten' => 'Phòng đóng gói'
            ],
            [
                'ten' => 'Phòng vận chuyển'
            ]
        ];

        foreach ($data as $v){
            $pb = App\Models\PhongBan::create($v);
        }
    }
}

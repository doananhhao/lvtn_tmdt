<?php

use Illuminate\Database\Seeder;

class ThanhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loai = App\Models\LoaiUser::where('tenloai', 'like', '%Người dùng%')->first();
        $users = $loai->User()->get();

        foreach ($users as $user){
            $user->ThanhVien()->create([
                'diemtichluy' => 0
            ]);
        }
    }
}

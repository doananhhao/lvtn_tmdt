<?php

use Illuminate\Database\Seeder;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loai = App\Models\LoaiUser::where('tenloai', 'like', '%Nhân viên%')->first();
        $users = $loai->User()->get();

        foreach ($users as $user){
            $user->NhanVien()->create([
                'phongban_id' => App\Models\PhongBan::inRandomOrder()->first()->id,
                'chucvu_id' => App\Models\ChucVu::where('ten', 'like', '%Nhân viên%')->first()->id,
                'luong' => 0,
            ]);
        }

        //Tạo trưởng phòng
        $cv_tp = App\Models\ChucVu::where('ten', 'like', '%Trưởng phòng%')->first()->id;
        foreach (App\Models\PhongBan::all() as $pb){
            $nv = $pb->NhanVien()->inRandomOrder()->first();
            $nv->chucvu_id = $cv_tp;
            $nv->save();
            $phongban = App\Models\PhongBan::find($pb->id);
            $phongban->truongphong_id = $nv->id;
            $phongban->save();
        }
    }
}

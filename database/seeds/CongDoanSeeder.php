<?php

use Illuminate\Database\Seeder;
use App\Models\CongDoan;
class CongDoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pb_kt = App\Models\PhongBan::where('ten', 'like', '%kiểm tra%')->first();
        $cd_1 = $pb_kt->CongDoan()->create([
            'mota' => 'Kiểm tra hàng hóa của đơn đặt hàng',
        ]);

        $pb_dg = App\Models\PhongBan::where('ten', 'like', '%đóng gói%')->first();
        $cd_2 = $pb_dg->CongDoan()->create([
            'FK_congdoantruoc' => $cd_1->id,
            'mota' => 'Đóng gói đơn đặt hàng',
        ]);
        $cd_1->FK_congdoansau = $cd_2->id;
        $cd_1->save();

        $pb_vc = App\Models\PhongBan::where('ten', 'like', '%vận chuyển%')->first();
        $cd_3 = $pb_vc->CongDoan()->create([
            'FK_congdoantruoc' => $cd_2->id,
            'mota' => 'Vận chuyển đơn đặt hàng cho người đặt mua',
        ]);
        $cd_2->FK_congdoansau = $cd_3->id;
        $cd_2->save();
    }
}

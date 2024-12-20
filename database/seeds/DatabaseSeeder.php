<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CapDoSeeder::class,
            LoaiUserSeeder::class,
            UserSeeder::class,
            ThanhVienSeeder::class,
            LoaiSPSeeder::class,
            NhaCungCapSeeder::class,
            SanPhamSeeder::class,
            KhuyenMaiSeeder::class,
            BinhLuanSeeder::class,
            HoaDonSeeder::class,
            PhongBanSeeder::class,
            ChucVuSeeder::class,
            NhanVienSeeder::class,
            CongDoanSeeder::class,
        ]);
    }
}

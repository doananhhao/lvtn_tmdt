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
            LoaiUserSeeder::class,
            UserSeeder::class,
            ThanhVienSeeder::class,
            LoaiSPSeeder::class,
            NhaCungCapSeeder::class,
            KhuyenMaiSeeder::class,
            SanPhamSeeder::class,
        ]);
    }
}

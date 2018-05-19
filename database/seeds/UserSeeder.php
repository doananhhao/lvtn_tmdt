<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loai = App\Models\LoaiUser::all();
        $sl = 0;
        foreach ($loai as $v){
            for ($i = 0; $i <= $sl; $i++)
                $v->User()->save(factory(App\User::class)->make());
            $sl++;
        }
    }
}

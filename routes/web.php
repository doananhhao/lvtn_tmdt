<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('shop.home');
});

Route::get('/test', function (){
    // $loai = App\Models\LoaiUser::where('tenloai', 'like', '%Người dùng%')->first();
    // $users = $loai->User()->get();
    // echo "<pre>";
    // foreach ($users as $user)
    //     var_dump($user);

    echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 3 days'));
});
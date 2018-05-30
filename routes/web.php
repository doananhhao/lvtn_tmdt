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

Route::get('/test', function (){
    // $loai = App\Models\LoaiUser::where('tenloai', 'like', '%Người dùng%')->first();
    // $users = $loai->User()->get();
    echo "<pre>";
    // foreach ($users as $user)
    var_dump($user);

    // echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 3 days'));

    // session(['cart' => [1,2,3,4]]);
    // echo "lưu session";
});
Route::get('t2', 'Shop\HomeController@test');

/**
 * 
 */

Auth::routes();

Route::group(['prefix'=>'/home'], function () {
    Route::get('/', 'Shop\HomeController@index')->name('home');

    Route::group(['prefix' => '/gio-hang'], function (){
        Route::get('/', 'Shop\ShoppingCart@index')->name('cart');
        Route::post('/cart-minus', 'Shop\ShoppingCart@cartMinus')->name('cart_minus');
        Route::post('/cart-plus', 'Shop\ShoppingCart@cartPlus')->name('cart_plus');
        Route::post('/add-to-cart', 'Shop\ShoppingCart@add_to_cart')->name('add-to-cart');
        Route::post('/remove', 'Shop\ShoppingCart@remove')->name('remove');
    });

    Route::get('loai-san-pham/{type}',['as'=>'loaisanpham','uses'=>'PageController@getLoaiSp']);
	Route::get('chi-tiet-san-pham/{tensp}',['as'=>'chitietsanpham','uses'=>'PageController@getChitiet']);
});

Route::group(['prefix' => '/admin'], function (){
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('san-pham/{id}/image', 'Admin\SanPhamController@showImage')->name('san-pham.images');
    Route::post('san-pham/{id}/image', 'Admin\SanPhamController@createImage')->name('san-pham.create_images');
    Route::resources([
        'nha-cung-cap' => 'Admin\NhaCungCapController',
        'loai-san-pham' => 'Admin\LoaiSPController',
        'san-pham' => 'Admin\SanPhamController',
        'loai-khuyen-mai' => 'Admin\LoaiKhuyenMaiController',
    ]);
});

Route::get('/', function(){
    return redirect()->route('home');
});
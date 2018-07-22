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
    
    // dd(App\Models\ChiTietHoaDon::find(81)->LoaiKhuyenMai->ChiTietKhuyenMai()->where('sanpham_id', 19)->first());
    // $tencapdo_daily = "Đại lý";
    // dd(App\Models\CapDo::where('capdo', 'LIKE', '%'.$tencapdo_daily.'%')->orderBy('id', 'asc')->first());
    // dd(App\Models\PhongBan::join('NhanVien','PhongBan.truongphong_id','NhanVien.nhanvien_id')->where('PhongBan.id','1')->get());
    dd(App\User::find(6)->trangthai == 1);
    // foreach ($users as $user)
    // var_dump($user);
    // foreach (App\Models\HoaDon::find(1)->ChiTietHoaDon as $cthd)
    //     $cthd->SanPham->ChiTietKhuyenMai()->where([['loaikm_id', 'dk1'], ['column', 'dk2']])
    // echo route('loai-khuyen-mai.chi-tiet-khuyen-mai.show', ['loai_khuyen_mai' => 5, 'chi-tiet-khuyen-mai' => 9]);

    // var_dump(App\Models\DanhGia::find(4, 2)->toArray());

    // echo date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 3 days'));

    // session(['cart' => [1,2,3,4]]);
    // echo "lưu session";
})->name('test1');
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
        Route::post('muahang', 'Shop\ShoppingCart@muahang')->name('muahang');
    });

    Route::get('loai-san-pham/{type}',['as'=>'loaisanpham','uses'=>'PageController@getLoaiSp']);
    Route::get('chi-tiet-san-pham/{tensp}',['as'=>'chitietsanpham','uses'=>'PageController@getChitiet']);
    Route::get('san-pham-dai-ly',['as'=>'sanphamdaily','uses'=>'PageController@getSpDaiLy']);
    Route::get('chi-tiet-san-pham-daily/{tenspdl}',['as'=>'chitietsanphamdaily','uses'=>'PageController@getChitietSPDL']);
    Route::post('/comment/{id}', 'PageController@comment')->name('comment');

    Route::get('/chinh-sach-ban-hang', 'PageController@csbh')->name('csbh');
    Route::get('/thong-tin', 'PageController@about')->name('thongtin');
    Route::get('/tim-kiem', 'PageController@searchSP')->name('tim-kiem');
});
Route::group(['prefix' => 'thong-tin-tai-khoan'], function() {
        Route::get('information', 'InfoController@getInfo')->name('acc-info');
        Route::post('/save-edit-user', 'InfoController@save_edit_user')->name('edit-info');  
        Route::get('level', 'InfoController@getLevel')->name('level');

        Route::get('/orderlist', 'InfoController@list_order')->name('order_list');
        Route::get('/cancelorderlist', 'InfoController@list_order_cancel')->name('cancel_order_list');
        Route::get('/details/{id}', 'InfoController@order_detail')->where('id', '[0-9]+')->name('order-detail');
        Route::get('/orderlist/status/{status}', 'InfoController@order_status')->name('order_status'); 
        
        Route::get('/cancelorderdetails/{id}', 'InfoController@order_detail_cancel')->where('id', '[0-9]+')->name('cancel-order-detail');        
        
        Route::get('/selllist', 'InfoController@list_sell')->name('sell_list');
        Route::get('/sell', 'InfoController@sell')->name('sell'); 
        Route::post('/sell', 'InfoController@sell_product')->name('sell-product');  
        Route::get('/sellinfo/{id}', 'InfoController@sellinfo')->name('sell-show'); 
        Route::get('/selllist/status/{status}', 'InfoController@dangban_status')->name('dangban_status');  
        
        Route::post('/stopsell/{id}', 'InfoController@save_stop_sell')->name('stop-sell');  
        Route::post('/contsell/{id}', 'InfoController@save_cont_sell')->name('cont-sell'); 
        Route::get('/selledit/{id}', 'InfoController@sell_edit')->name('sell-edit');
        Route::post('/selledit/{id}', 'InfoController@save_edit_sell')->name('edit-sell');  

        Route::post('/create-daily/{id}', 'InfoController@create_daily')->name('create-daily');  
        
        Route::get('/changePassword','HomeController@showChangePasswordForm')->name('change-password');
        Route::post('/changePassword','HomeController@changePassword')->name('changePassword');

        
});
Route::group(['prefix' => '/admin', 'middleware' => ['m_admin']], function (){
    // Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::get('/thong-tin', 'Admin\TaiKhoanController@index')->name('thongtintaikhoan');

    Route::group(['middleware' => ['taikhoan:Quản trị viên']], function(){
        Route::get('san-pham/{id}/image', 'Admin\SanPhamController@showImage')->name('san-pham.images');
        Route::post('san-pham/{id}/image', 'Admin\SanPhamController@createImage')->name('san-pham.create_images');
        Route::resources([
            'nha-cung-cap' => 'Admin\NhaCungCapController',
            'loai-san-pham' => 'Admin\LoaiSPController',
            'san-pham' => 'Admin\SanPhamController',
            'loai-khuyen-mai' => 'Admin\LoaiKhuyenMaiController',
            'loai-khuyen-mai.chi-tiet-khuyen-mai' => 'Admin\CTKMController',
            'ql-tai-khoan' => 'Admin\QLDSTaiKhoanController'
        ]);

        Route::group(['as' => 'ql-tai-khoan.'], function (){
            Route::get('/tinhtrang', 'Admin\QLDSTaiKhoanController@change_user_status')->name('change_user_status');
            Route::get('/doi-thong-tin-nhanvien', 'Admin\QLDSTaiKhoanController@change_nv')->name('change_nv');
            Route::get('/get-nhanvien', 'Admin\QLDSTaiKhoanController@get_nv')->name('get_nv');
        });

        Route::group(['prefix' => '/ds-hoa-don', 'as' => 'hoa-don-admin.'], function(){
            Route::get('/', 'Admin\XLHoaDon\DSHoaDonController@admin_index')->name('index');
            Route::get('/chi-tiet/{id}', 'Admin\XLHoaDon\DSHoaDonController@detail')->name('detail');
            Route::get('/hoa-don-khong-huy', 'Admin\XLHoaDon\DSHoaDonController@admin_bt')->name('hdkhonghuy');
            Route::get('/hoa-don-da-huy', 'Admin\XLHoaDon\DSHoaDonController@admin_dahuy')->name('hddahuy');
        });

        Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.'], function(){
            Route::get('/', 'Admin\DashBoardController@index')->name('index');
            Route::get('/chart-san-pham', 'Admin\DashBoardController@ajax_chart_sanpham')->name('chart_sanpham');
        });
    });

    Route::group(['middleware' => ['taikhoan:Moderator']], function(){
        Route::group(['prefix' => '/danh-gia', 'as' => 'danh-gia.'], function (){
            Route::get('/', 'Admin\Duyet\DanhGiaController@index')->name('index');
            Route::get('/{id_tv}-{id_sp}', 'Admin\Duyet\DanhGiaController@show')->name('show');
            Route::post('/tinhtrang', 'Admin\Duyet\DanhGiaController@changeTinhTrang')->name('tinhtrang');
        });
        //đăng bán
        Route::resources([
            'dang-ban' => 'Admin\Duyet\DangBanController',
        ]);
        Route::group(['prefix' => '/dang-ban', 'as' => 'dang-ban.'], function (){
            Route::post('/tinhtrang', 'Admin\Duyet\DangBanController@changeTinhTrang')->name('tinhtrang');
        });
        //bình luận
        Route::group(['prefix' => '/binh-luan', 'as' => 'binh-luan.'], function (){
            Route::get('/', 'Admin\Duyet\BinhLuanController@index')->name('index');
            Route::get('/tinhtrang', 'Admin\Duyet\BinhLuanController@changeTinhTrang')->name('tinhtrang');
        });
    });

    Route::group(['prefix' => '/hoa-don', 'as' => 'hoa-don.', 'middleware' => ['taikhoan:Nhân viên']], function (){
        Route::group(['middleware' => ['chucvu:Trưởng phòng']], function(){
            Route::get('/moi_dat', 'Admin\XLHoaDon\KTHoaDonController@index')->name('index');
            Route::get('/xu_ly_lai', 'Admin\XLHoaDon\KTHoaDonController@index2')->name('xulylai');
            Route::get('/da_phan_cong', 'Admin\XLHoaDon\KTHoaDonController@index3')->name('daphancong');
            Route::get('/htphancong', 'Admin\XLHoaDon\KTHoaDonController@index4')->name('hdhoanthanhpc');
            Route::get('/xu_ly_lai/rework', 'Admin\XLHoaDon\KTHoaDonController@xllHoaDon')->name('rework');
            Route::get('/ds_nhanvien_phancong', 'Admin\XLHoaDon\KTHoaDonController@getPCNV')->name('dsnvpc');
            Route::post('/nhanvien_phancong', 'Admin\XLHoaDon\KTHoaDonController@setPCNV')->name('phancongnv');
            Route::get('/huy_hoa_don', 'Admin\XLHoaDon\KTHoaDonController@huyHoaDon')->name('huy');
            Route::get('/hoan_thanh', 'Admin\XLHoaDon\KTHoaDonController@hoanthanhCongDoanHoaDon')->name('htcdhd');
        });
        Route::group(['middleware' => ['chucvu:Nhân viên']], function(){
            Route::get('/', 'Admin\XLHoaDon\ThucHienHoaDonController@index')->name('dshd_canlam');
            Route::get('/chitietpc', 'Admin\XLHoaDon\ThucHienHoaDonController@getPC')->name('chitietpc');
            Route::post('/baocaocv', 'Admin\XLHoaDon\ThucHienHoaDonController@setStatusPC')->name('baocaocv');
        });

        Route::get('/hoa-don-da-lam', 'Admin\XLHoaDon\DSHoaDonController@index')->name('dshd_dalam');
    });
});

Route::get('/admin', function(){
    return redirect()->route('thongtintaikhoan');
});
Route::get('/', function(){
    return redirect()->route('home');
});
Route::post('/logout', function(){
    auth()->logout();
    return redirect()->route('home');
})->name('logout');
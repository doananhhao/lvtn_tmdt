<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HoaDon;
use App\Models\CongDoan;
use App\Models\CongDoanHoaDon;
use App\Models\PhongBan;
use App\Models\LoaiUser;
use App\Models\LoaiSP;
use App\Models\SanPham;
use App\User;

class DashBoardController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = 'Dashboard';
        $this->data['title2'] = 'Thống kê';
    }

    function index(){
        $this->data['hd'] = HoaDon::all();
        $this->data['hd_dahuy'] = HoaDon::where('dahuy', 1)->get();
        $this->thongke_hoadon();
        $this->thongke_user();
        return view('admin.dashboard.index', $this->data);
    }

    private function thongke_user(){
        $this->data['user'] = User::all();
        $this->data['user_khoa'] = User::where('trangthai', 0)->get();
        $this->data['loaiuser'] = LoaiUser::all();
    }

    private function thongke_hoadon(){
        $cd_vc = CongDoan::where('mota', 'LIKE', '%Vận chuyển%')->first();
        $cd_dg = CongDoan::where('mota', 'LIKE', '%Đóng gói%')->first();
        $cd_kt = CongDoan::where('mota', 'LIKE', '%Kiểm tra%')->first();

        $this->data['hd_dahoanthanh'] = CongDoanHoaDon::where([
            ['congdoan_id', $cd_vc->id],
            ['status', 1]
        ])->get()->count();

        $this->data['hd_dangkiemtra'] = $this->gettotalCDHD($cd_kt)->count();

        $this->data['hd_dangdonggoi'] = $this->gettotalCDHD($cd_dg)->count();

        $this->data['hd_dangvanchuyen'] = $this->gettotalCDHD($cd_vc)->count();
    }

    private function gettotalCDHD($congdoan){
        $ds_id = [];
        $ds_id_hd = [];
        $status = 0;

        foreach ($congdoan->CongDoanHoaDon()->where('status', $status)->orderBy('id', 'desc')->get() as $cdhd){
            if ($cdhd->HoaDon->dahuy == 1)
                continue;
            if (array_search($cdhd->hoadon_id, $ds_id_hd) === false){
                $ds_id_hd[] = $cdhd->hoadon_id;
                $ds_id[] = $cdhd->id;
            }
        }
        
        $id = $congdoan->id;
        $flag = false;
        $ds_id_cdhd_su_dung = [];
        while($id != 1 && $flag == false){
            $cd_truoc = $congdoan->CongDoanTruoc;
            // foreach (HoaDon::whereIn('id', $ds_id_hd)->get() as $hd){
            foreach (CongDoanHoaDon::whereIn('id', $ds_id)->get() as $cdhd){
                //công đoạn hóa đơn CỦA công đoạn trước với ID last
                $cdhd_cd_truoc = $cdhd->HoaDon->CongDoanHoaDon()->where('congdoan_id', $cd_truoc->id)->orderBy('id', 'desc')->first();
                if ($cdhd_cd_truoc->id < $cdhd->id)
                    $ds_id_cdhd_su_dung[] = $cdhd->id;
            }
            $flag = true;
        }
        if ($id == 1){
            $ds_id_cdhd_su_dung = $ds_id;
        }

        return collect($ds_id_cdhd_su_dung);
    }

    function ajax_chart_sanpham(){
        $loaisp = LoaiSP::all()->reverse();

        $return = [];
        $totalspc = 0;
        $totalspdb = 0;
        $labels = [];
        $dataSPC = [];
        $dataSP_nguoidung = [];
        $bgColor = [];
        $bdColor = [];

        $colorArr = $this->rand_color($loaisp->count());
        foreach ($colorArr as $color){
            $bgColor[] = $this->convert_to_RGBA($color, 0.5);

            // $bdColor[] = 'rgba(255, 255, 255, 1)';
            $bdColor[] = $this->convert_to_RGBA($color, 1);
        }
        foreach ($loaisp as $loai){
            $labels[] = $loai->tenloai;
            $spdangban = 0;
            $spc = 0;
            foreach ($loai->SanPham as $sp){
                if ($sp->DangBan()->first() != null)
                    $spdangban++;
                else
                    $spc++;
            }
            $totalspc += $spc;
            $totalspdb += $spdangban;
            $dataSP_nguoidung[] = $spdangban;
            $dataSPC[] = $spc;
        }
        $return['labels'] = $labels;
        $return['dataSPC'] = $dataSPC;
        $return['dataSP_nguoidung'] = $dataSP_nguoidung;
        $return['bgColor'] = $bgColor;
        $return['bdColor'] = $bdColor;
        $return['title'] = 'Sản phẩm chính ('.$totalspc.') và sản phẩm đăng bán ('.$totalspdb.')';

        return response()->json($return);
    }

    private function rand_color($num){
        $colorArr = [];
        for($i = 0; $i < $num; $i++){
            $rgbColor = array();
            //Create a loop.
            foreach(array('r', 'g', 'b') as $color){
                $rgbColor[$color] = mt_rand(0, 255);
            }
            $colorArr[] = $rgbColor;
        }

        return $colorArr;
    }

    private function convert_to_RGBA($rgbColor, $opacity = 0.2){
        return 'rgba('.implode(',', $rgbColor).','.$opacity.')';
    }
}

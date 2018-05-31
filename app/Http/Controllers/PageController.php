<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SanPham;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\LoaiSP;
use App\Models\ChiTietKhuyenMai;
use App\Models\BinhLuan;
use App\Models\DanhGia;
use App\Models\ThanhVien;





class PageController extends Controller
{
    public function getIndex(){
       
    	$sp_theoloai = LoaiSP::all();
        
        return view('shop.home',compact('sp_theoloai'));
    }
  
    public function getLoaiSp($type){
        $sidemenu = LoaiSP::all();
        $sp_theoloai = LoaiSP::all();
        $loaisp = SanPham::where('loaisp_id',$type)->get();
       
        return view('shop.layouts.page.loaisanpham',compact('sidemenu', 'sp_theoloai','loaisp'));
    }
    public function getChitiet($id){
    	$sanpham = SanPham::where('id',$id)->first();
    	$list = ChiTietKhuyenMai::select(DB::raw('max(giamgia) as giamgia, sanpham_id'))
                ->where('ngayketthuc', '>=', date('Y-m-d H:i:s'))
                ->orWhere('ngayketthuc', null)
                ->groupBy('sanpham_id')
                ->orderBy('giamgia', 'desc')
                ->limit(3)
                ->get();
        $giamgiadb = [];
        foreach ($list as $v){
            $sp = SanPham::find($v->sanpham_id);
            $sp->giamgia = $v->giamgia;
            $giamgiadb[] = $sp;
        }
        $sobinhluan = BinhLuan::where('sanpham_id',$id)->count();
        $binhluan = BinhLuan::join('users','user_id','=','users.id')->where('sanpham_id',$id)->paginate(10);

        //$sodanhgia = DanhGia::where('sanpham_id',$id)->count();
        //$danhgia = DanhGia::join('thanhvien','thanhvien_id','=','users.id')->join('users','user_id','=','users.id')->where('sanpham_id',$id)->paginate(10);
        
    	return view('shop.layouts.page.chitietsanpham',compact('sanpham','giamgiadb','binhluan','sobinhluan','sodanhgia','danhgia'));
    } 

    public function getInfo(){
        return view('shop.layouts.page.info');
    }
    public function searchSP(){
        return view('shop.layouts.page.timkiem');
    }
     
    public function getAbout(){
    	return view('page.gioithieu');
    }
    
    
    
    
    
    
}

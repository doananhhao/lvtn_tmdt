<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\SanPham;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\LoaiSP;
use App\Models\ChiTietKhuyenMai;





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
    	return view('shop.layouts.page.chitietsanpham',compact('sanpham','giamgiadb'));
    } 
     
    public function getAbout(){
    	return view('page.gioithieu');
    }
    
    
    
    
    
    
}

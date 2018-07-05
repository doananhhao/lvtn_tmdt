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
use App\Models\DangBan;

use Illuminate\Support\Facades\Auth;





class PageController extends Controller
{
    public function getIndex(){
       
    	$sp_theoloai = LoaiSP::all();
        
        return view('shop.home',compact('sp_theoloai'));
    }
  
    public function getLoaiSp($type){
        $sidemenu = LoaiSP::all();
        $sp_theoloai = LoaiSP::all();
        
        $loaisp = SanPham::where('loaisp_id',$type)->paginate(12); 
        $db=DangBan::all();
        // $spdb=array();
        // foreach($loaisp as $a){
        //     foreach($db as $s){ 
        //         if($a['id'] != $s['sanpham_id']){ 
        //             continue;
        //         }
        //         else{
        //             array_push($spdb,$a);
        //             break;
        //         }
        //     }
        // }
        // $sp=array();
        // foreach($loaisp as $a){
        //     foreach($spdb as $s){ 
        //         if($a['id'] != $s['id']){ 
        //             continue;
        //         }
        //         else{
        //             array_push($spdb,$a);
        //             break;
        //         }
        //     }
        // }
        // dd($sp); 
        //$loaisp = SanPham::where('loaisp_id',$type)->where('SanPham.id','!=','DangBan.sanpham_id')->paginate(12);
        //$loaispa = $loaisp->DangBan->where('sanpham_id','!=',$loaisp)->paginate(12);
        
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

    public function comment(Request $request,$id){

        //$tvdb = ThanhVien::where('user_id',Auth::user()->id)->first();
        $comment=BinhLuan::create([
            'user_id' => Auth::user()->id,
            'sanpham_id' => $id,
            'noidung' => $request->bl
        ]);
        
        
        
        return back()->with('success', 'Cám ơn bạn đã bình luận cho sản phẩm này'.$request->tensanpham)->withInput();
    }

    public function getSpDaiLy(){
        $sidemenu = LoaiSP::all();
        //$sp_theoloai = LoaiSP::all();
        
        $loaisp = SanPham::join('DangBan','DangBan.sanpham_id','SanPham.id')->where('canduyet',0)->where('ngungban',0)->paginate(12);
        //dd($loaisp);
        return view('shop.layouts.page.sanphamdangban',compact('sidemenu','loaisp'));
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

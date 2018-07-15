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
use App\User;
use Illuminate\Support\Facades\Auth;





class PageController extends Controller
{
    public function getIndex(){
       
    	$sp_theoloai = LoaiSP::all();
        
        return view('shop.home',compact('sp_theoloai'));
    }
  
    public function getLoaiSp($type){
        
        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        $sp_theoloai = LoaiSP::all();
        
        $tenlsp = LoaiSP::where('id',$type)->first();
        $loaisp = SanPham::where('loaisp_id',$type)->paginate(12);
        $db=DangBan::all();
        $title=$tenlsp->tenloai;
        $is_type = $type;
        //$loaisp = SanPham::where('loaisp_id',$type)->where('SanPham.id','!=','DangBan.sanpham_id')->paginate(12);
        //$loaispa = $loaisp->DangBan->where('sanpham_id','!=',$loaisp)->paginate(12);
        
        return view('shop.layouts.page.loaisanpham',compact('title','sidemenu', 'sp_theoloai','loaisp','tenlsp', 'is_type'));
    }
    public function getChitiet($id){
        
        $sanpham = SanPham::where('id',$id)->first();
        $tenlsp = LoaiSP::where('id',$sanpham->loaisp_id)->first();

        $title="Chi tiết sản phẩm - ".$sanpham->tensanpham;

        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();

    	$list = ChiTietKhuyenMai::select(DB::raw('max(giamgia) as giamgia, sanpham_id'))
                ->where([
                    ['ngayketthuc', '>=', date('Y-m-d H:i:s')],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->orWhere([
                    ['ngayketthuc', null],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
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
        //
        $giamgia = $sanpham->ChiTietKhuyenMai()->where([
                        ['ngayketthuc', '>=', date('Y-m-d H:i:s')],
                        ['ngaybd', '<=', date('Y-m-d H:i:s')]
                    ])
                    ->orWhere([
                        ['ngayketthuc', null],
                        ['ngaybd', '<=', date('Y-m-d H:i:s')]
                    ])->orderBy('giamgia', 'desc')->first();
        //
        $sobinhluan = BinhLuan::where('sanpham_id',$id)->count();
        $binhluan = BinhLuan::join('users','user_id','=','users.id')->where('sanpham_id',$id)->where('status',1)->paginate(10);

        $sodanhgia = DanhGia::where('sanpham_id',$id)->count();
        //$danhgia = DanhGia::join('thanhvien','thanhvien_id','=','users.id')->join('users','user_id','=','users.id')->where('sanpham_id',$id)->paginate(10);
        
        $spcungloai = SanPham::where('loaisp_id',$sanpham->loaisp_id)->get();
        //dd($spcungloai);

    	return view('shop.layouts.page.chitietsanpham',compact('title', 'sidemenu', 'giamgia', 'sanpham','giamgiadb','binhluan','sobinhluan','sodanhgia','danhgia','tenlsp','spcungloai'));

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
       // $this->data['title'] = "Sản phẩm của Thành viên";
        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        //$sp_theoloai = LoaiSP::all();
        $title="Sản phẩm của Thành viên";
        $loaisp = SanPham::join('DangBan','DangBan.sanpham_id','SanPham.id')->where('canduyet',0)->where('ngungban',0)->paginate(12);
        //dd($loaisp);
        return view('shop.layouts.page.sanphamdangban',compact('sidemenu','loaisp','title'));
    }


    public function getChitietSPDL($id){
        /**
         * $id tồn tại sp ko
         * ...
         * ...
         * những phần trên nữa
         */
        $sanpham = SanPham::where('id',$id)->first();
        $tenlsp = LoaiSP::where('id',$sanpham->loaisp_id)->first();

        $title="Chi tiết sản phẩm - ".$sanpham->tensanpham;

        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        

        $list = ChiTietKhuyenMai::select(DB::raw('max(giamgia) as giamgia, sanpham_id'))
                ->where([
                    ['ngayketthuc', '>=', date('Y-m-d H:i:s')],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->orWhere([
                    ['ngayketthuc', null],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
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

        $tvdangban= SanPham::join('DangBan','SanPham.id','DangBan.sanpham_id')->first();
        $sdttv=User::where('id',$tvdangban->thanhvien_id)->first();
    	//dd($sdttv);
        $sobinhluan = BinhLuan::where('sanpham_id',$id)->count();
        $binhluan = BinhLuan::join('users','user_id','=','users.id')->where('sanpham_id',$id)->where('status',1)->paginate(10);

        
        $spcungloai = SanPham::where('loaisp_id',$sanpham->loaisp_id)->get();
        //dd($spcungloai);

    	return view('shop.layouts.page.chitietspdl',compact('title', 'sidemenu', 'sdttv','sanpham','giamgiadb','binhluan','sobinhluan','sodanhgia','danhgia','tenlsp','spcungloai'));

    } 

    public function getInfo(){
        return view('shop.layouts.page.info');
    }
    public function searchSP(Request $request){
        $loaisp = null;
        if ($request->has('loaisp'))
            $loaisp = $request->get('loaisp');
        if (!$request->has('search_input'))
            return back();
        $search = $request->search_input;
        $title = "Tìm kiếm - ".$search;
        if (LoaiSP::find($loaisp) != null){
            $dssp = SanPham::where([
                ['tensanpham', 'LIKE', '%'.$search.'%'],
                ['loaisp_id', $loaisp]
            ])->paginate(12);
            $tenlsp = LoaiSP::find($loaisp);
        }else{
            $dssp = SanPham::where('tensanpham', 'LIKE', '%'.$search.'%')->paginate(12);
            $tenlsp = null;
        }
        $sidemenu = LoaiSP::all();
        return view('shop.layouts.page.loaisanpham', [
            'loaisp' => $dssp, 
            'tenlsp' => $tenlsp,
            'sidemenu' => $sidemenu,
            'title' => $title
        ]);
    }
     
    public function getAbout(){
    	return view('page.gioithieu');
    }
    
    public function csbh(){
        return view('shop.chinhsachbanhang');
    }
    
    
    
    
}

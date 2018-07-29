<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use App\Models\SanPham;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\LoaiSP;
use App\Models\ChiTietKhuyenMai;
use App\Models\CongDoanHoaDon;
use App\Models\BinhLuan;
use App\Models\DanhGia;
use App\Models\ThanhVien;
use App\Models\DangBan;
use App\Models\DaiLy;
use App\Models\CapDo;
use App\Models\DuyetDangBanHistory;
use App\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    
    //public $daily = [];

    public function getIndex(){
       
    	$sp_theoloai = LoaiSP::all();
        
        return view('shop.home',compact('sp_theoloai'));
    }
  
    public function getLoaiSp($type){
        if ($type == null)
            return abort(404);

        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        $sp_theoloai = LoaiSP::all();
        
        $tenlsp = LoaiSP::where('id',$type)->first();
        $loaisp = SanPham::where('loaisp_id',$type)->paginate(12);
        //dd($loaisp);
        $db=DangBan::all();
        $title=$tenlsp->tenloai;
        $is_type = $type;
        ///
        
        ///
        //$loaisp = SanPham::where('loaisp_id',$type)->where('SanPham.id','!=','DangBan.sanpham_id')->paginate(12);
        //$loaispa = $loaisp->DangBan->where('sanpham_id','!=',$loaisp)->paginate(12);
        
        return view('shop.layouts.page.loaisanpham',compact('title','sidemenu', 'sp_theoloai','loaisp','tenlsp', 'is_type'));
    }
    public function getChitiet($id, Request $request){
        //check sp
        if ($id == null)
            return abort(404);
        //check sp ko có trong đăng bán
        
        $sp = SanPham::find($id);
        if ($sp == null)    return abort(404);
        else if ($sp->DangBan()->first() != null)
            return abort(404);
        
        // $spchinh=DangBan::where('sanpham_id',$id)->first();
        // if ($spchinh != null)
        //     return abort(404);

        $daily = [];    
        $hash = $request->hash;
        
        if (Session::has('daily'))
            $daily = Session::get('daily');
        // dd($daily);
        //check hash nếu tồn tại
        $dailygioithieu=DaiLy::where('hash',$hash)->first();
        if ($dailygioithieu != null){
            $daily[$id] = $hash;
        }
        //ghi vào sesion
        Session::put('daily', $daily);       
        

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
        $giamgiadb  = [];
        foreach ($list as $v){
            $sp = SanPham::find($v->sanpham_id);
            $sp->giamgia = $v->giamgia;
            $dg = $sp->DanhGia;
            if ($dg->isEmpty())
                $score = 5;
            else {
                // 1 vote tối đa 10 sao
                $star = 0;
                $vote_count = 0;
                foreach ($dg as $v){
                    $vote_count++;
                    $star += $v->votes;
                }
                $score = round($star / $vote_count);
            }
            $sp->score = $score/2;
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
        //$binhluan = BinhLuan::join('users','user_id','=','users.id')->where('sanpham_id',$id)->where('status',1)->paginate(10);
        $binhluan = User::join('BinhLuan','users.id','BinhLuan.user_id')->where('BinhLuan.sanpham_id',$id)->where('BinhLuan.status',1)->paginate(10);

        /// test
        // kiểm tra đã mua sp hay chưa

        //
        if (Auth::check()){
            $cthd = ChiTietHoaDon::where('sanpham_id', $id)->get();
            $damua = false; //boolean: đã mua hay chưa
            if ($cthd != null){
                foreach ($cthd as $v){
                    if ($v->HoaDon->user_id == Auth::User()->id)
                        $damua = true;
                }
            }
            $dadg = null; //null: chưa có đánh giá hoặc chưa mua
            if ($damua)
                $dadg = DanhGia::find(Auth::User()->id, $id);
        }
        
        $sodanhgia = DanhGia::where('sanpham_id',$id)->where('tinhtrang',1)->count();
        $danhgiasp = User::join('DanhGia','users.id','DanhGia.thanhvien_id')->where('DanhGia.sanpham_id',$id)->where('DanhGia.tinhtrang',1)->paginate(10);
        $spcungloai = SanPham::where('loaisp_id',$sanpham->loaisp_id)->get();

        $danhgiatrungbinh = DanhGia::where('sanpham_id',$id)->where('tinhtrang',1)->get();

        $star = 0;
        $vote_count = 0;
        $score1 = 0;
        $score2 = 0;

        foreach($danhgiatrungbinh as $tb){
            $vote_count++;
            $star += $tb->votes;
        }
        if($vote_count == 0 && $star == 0){
            $score1 = 2.5*2;
            $score2 = 3;
        }else{
            $score1 = $star/$vote_count;
            $score2 = round($score1/2);
        }
        
        //dd($spcungloai);
        //

        // if (Auth::check()){
        //     $hoadon = HoaDon::where('user_id',Auth::user()->id)->get();
        //     $chitiethoadon = ChiTietHoaDon::orderBy('id', 'desc')->get();
        //     $listsp=array();
        //     if ($hoadon != null)
        //         foreach($hoadon as $hd){
        //                 foreach($chitiethoadon as $cthd){
        //                     if($cthd['hoadon_id'] == $hd['id']){
        //                         array_push($listsp,$cthd);
        //                     }
        //                 }
        //         }
            
        //     $spdamua=array();
            
        //     foreach($listsp as $list){
        //         if($list['sanpham_id'] == $id){
        //             array_push($spdamua,$list);
        //         }
        //     }
            
        //     $damua=0;
        //     $congdoanhoadon = CongDoanHoaDon::orderBy('id', 'desc')->get();
        //     foreach($spdamua as $spdm){
        //         foreach($congdoanhoadon as $cdhd){
        //             if($spdm['hoadon_id'] == $cdhd['hoadon_id']){
        //                 if($cdhd['congdoan_id'] == 3 && $cdhd['status'] == 1){
        //                     $damua=1;
        //                     break;
        //                 }
        //             }
        //         }
        //     }
        //     //
        //     //dd($damua);
        //     // kt đã đánh giá chưa
        //     $dadg=0;
        //     $danhgia = DanhGia::where('sanpham_id',$id)->get();
        //     foreach($danhgia as $dg){
        //         if($dg['thanhvien_id'] == Auth::user()->id){
        //             $dadg=1;
        //             break;
        //         }
        //     }
        //     ///
        //     $dadanhgia = DanhGia::where('sanpham_id',$id)->where('thanhvien_id',Auth::user()->id)->first();

        //     //dd($dadanhgia);
        //     //
        //     //$danhgiasp = DanhGia::join('users','thanhvien_id','=','users.id')->where('sanpham_id',$id)->where('DanhGia.thanhvien_id','!=',Auth::user()->id)->where('DanhGia.tinhtrang',1)->paginate(10);
        //     $danhgiasp = User::join('DanhGia','users.id','DanhGia.thanhvien_id')->where('DanhGia.sanpham_id',$id)->where('DanhGia.thanhvien_id','!=',Auth::user()->id)->where('DanhGia.tinhtrang',1)->paginate(10);
        // }
        
        

    	return view('shop.layouts.page.chitietsanpham',compact('score1','score2','danhgiasp','dadg','damua','title', 'sidemenu', 'giamgia', 'sanpham','giamgiadb','binhluan','sobinhluan','sodanhgia','dadanhgia','tenlsp','spcungloai'));

    } 

    public function comment(Request $request,$id){

        if ($id == null)
            return abort(404);

        $comment=BinhLuan::create([
            'user_id' => Auth::user()->id,
            'sanpham_id' => $id,
            'noidung' => $request->bl
        ]);
        
        
        
        return back()->with('success', 'Cám ơn bạn đã bình luận cho sản phẩm này')->withInput();
    }

    private function get_array_id($list){
        $array = [];
        foreach ($list as $v)
            $array[] = $v->id;
        return $array;
    }

    public function getSpDaiLy(Request $request){
       // $this->data['title'] = "Sản phẩm của Thành viên";
        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        //$sp_theoloai = LoaiSP::all();
        
        $loai = LoaiSP::find($request->loaisanpham);

        $ds_id = DuyetDangBanHistory::select(DB::raw('dangban_id, MAX(id) as id'))->groupBy('dangban_id')->get();
        $ds_id = $this->get_array_id($ds_id);
        $ds_id = DuyetDangBanHistory::whereIn('id', $ds_id)->where('status', 1)->get();
        $ds_id2 = []; //id dang bán
        foreach ($ds_id as $v)
            $ds_id2[] = $v->dangban_id;

        if ($loai == null){

            $title= "Sản phẩm của Thành viên";
            $title2= "Sản phẩm đăng bán";
            $dangban = DangBan::whereIn('id', $ds_id2)->orderBy('updated_at', 'desc')->paginate(9);

        }else{

            $title= $loai->tenloai." - Thành viên bán";
            $title2 = $loai->tenloai;
            $listdb = DangBan::whereIn('id', $ds_id2)->orderBy('updated_at', 'desc')->get();
            $ds_id = [];
            foreach ($listdb as $db)
                if ($db->SanPham->LoaiSP->id == $loai->id)
                    $ds_id[] = $db->id;
            $dangban = DangBan::whereIn('id', $ds_id)->orderBy('updated_at', 'desc')->paginate(9);

        }

        $dangban->appends(request()->query());
        return view('shop.layouts.page.sanphamdangban',compact('sidemenu','dangban','title', 'title2'));
    }


    public function getChitietSPDL($id){

        if ($id == null)
            return abort(404);

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
        $giamgiadb  = [];
        foreach ($list as $v){
            $sp = SanPham::find($v->sanpham_id);
            $sp->giamgia = $v->giamgia;
            $dg = $sp->DanhGia;
            if ($dg->isEmpty())
                $score = 5;
            else {
                // 1 vote tối đa 10 sao
                $star = 0;
                $vote_count = 0;
                foreach ($dg as $v){
                    $vote_count++;
                    $star += $v->votes;
                }
                $score = round($star / $vote_count);
            }
            $sp->score = $score/2;
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
        $title = 'Unicase - Chính sách bán hàng';
        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        $capdo = CapDo::all();
        return view('shop.chinhsachbanhang', ['title' => $title, 'sidemenu' => $sidemenu, 'capdo' => $capdo]);
    }

    public function about(){
        $title = 'Unicase - Thông tin';
        $sidemenu = LoaiSP::orderBy('id', 'desc')->get();
        return view('shop.about', ['title' => $title, 'sidemenu' => $sidemenu]);
    }

    //ajax
    public function review(Request $request,$id){

        if ($id == null)
            return abort(404);

        $comment=DanhGia::create([
            'thanhvien_id' => Auth::user()->id,
            'sanpham_id' => $id,
            'tieude' => 'null',
            'noidung' => $request->dg,
            'tinhtrang' => 0,
            'votes' => $request->score * 2
        ]);
        
        
        
        return back()->with('success', 'Cám ơn bạn đã đánh giá cho sản phẩm này')->withInput();
    }
    public function update_review(Request $request,$idsp,$idtv){

        if ($idsp == null)
            return abort(404);
        if ($idtv == null)
            return abort(404);
            
		$this->validate($request, [
				
            'dg'  => 'required'
            
        ]);

        $danhgia = DanhGia::where('sanpham_id',$idsp)->where('thanhvien_id',$idtv)->first();
        $danhgia->noidung = $request->dg;
        $danhgia->votes = $request->score * 2;
       
        $danhgia->save();

        return back()->with('success', 'Bạn đã cập nhật thành công ')->withInput();
    }
}

<?php

namespace App\Http\Controllers\Admin\XLHoaDon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\CongDoanHoaDon;
use App\Models\HoaDon;
use App\Models\PhanCong;
use App\Models\CongDoan;
use DB;
use Illuminate\Support\Facades\Auth;

class DSHoaDonController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];

    private $pb = null;
    private $chucvu = null;
    private $chucvunv = null;

    function __construct(){
        $this->data['title'] = "Danh sách hóa đơn đã xử lý thành công";
        $this->data['title2'] = 'Hoá đơn đã xử lý thành công ';
    }
//
    function index(){
        $this->getInfo();
        $ds_id_cdhd = [];
        if ($this->chucvu->id == $this->chucvunv->id){
            $ds_id_cdpc = $this->getHD_NV();
            $name = Auth::User()->name;
            $this->data['title2'] .= 'bởi nhân viên ['.$name.']';
            $ds_cd_pc_hd = PhanCong::whereIn('id', $ds_id_cdpc)->orderBy('id', 'desc')->paginate($this->paginate_set);
        }else{
            $ds_id_cdhd = $this->getHD_PB();
            $this->data['title2'] .= '['.$this->pb->ten.']';
            $ds_cd_pc_hd = CongDoanHoaDon::whereIn('id', $ds_id_cdhd)->orderBy('id', 'desc')->paginate($this->paginate_set);
        }
        
        $this->data['ds'] = $ds_cd_pc_hd;
        return view('admin.cdhd.index', $this->data);
    }

    //hoá đơn do nhân viên làm
    private function getHD_NV(){
        //chỉ lấy CD đã hoàn thành
        // $dspc = PhanCong::select(DB::raw('hoadon_id, MAX(id) as id'))->groupBy('hoadon_id')->get();
        // $ds_id_pc = [];
        // foreach($dspc as $pc)
        //     if (HoaDon::find($pc->hoadon_id)->dahuy == 0)
        //         $ds_id_pc[] = $pc->id;
        // $dspc = PhanCong::where([
        //     ['status', 1],
        //     ['nhanvien_id', Auth::User()->id]
        // ])->whereIn('id', $ds_id_pc)->get();
        // $ds_id = [];
        // foreach($dspc as $pc)
        //     $ds_id[] = $pc->id;
        // return $ds_id;

        $dspc = PhanCong::select(DB::raw('hoadon_id, MAX(id) as id'))->where([
                ['status', 1],
                ['nhanvien_id', Auth::User()->id]
        ])->groupBy('hoadon_id')->get();

        $ds_id_pc = [];
        foreach($dspc as $pc)
            if (HoaDon::find($pc->hoadon_id)->dahuy == 0)
                $ds_id_pc[] = $pc->id;

        return $ds_id_pc;
    }
    //hoá đơn do phòng ban làm
    private function getHD_PB(){
        return $this->getDS_lastid_CDHD();
    }

    private function getDS_lastid_CDHD(){
        //chỉ lấy CD đã hoàn thành
        $dscdhd = CongDoanHoaDon::select(DB::raw('hoadon_id, MAX(id) as id'))
                                ->where('congdoan_id', $this->pb->CongDoan()->first()->id)
                                ->groupBy('hoadon_id')->get();
        $ds_id_cdhd = [];
        foreach($dscdhd as $cdhd)
            if (HoaDon::find($cdhd->hoadon_id)->dahuy == 0)
                $ds_id_cdhd[] = $cdhd->id;
        $dscdhd_last_xong = CongDoanHoaDon::whereIn('id', $ds_id_cdhd)->where('status', 1)->get();
        $ds_id_cdhd2 = [];
        foreach($dscdhd_last_xong as $cdhd)
            if (HoaDon::find($cdhd->hoadon_id)->dahuy == 0)
                $ds_id_cdhd2[] = $cdhd->id;
        return $ds_id_cdhd2;
    }

    private function getInfo(){
        $this->pb = Auth::User()->NhanVien->PhongBan;
        $this->chucvu = Auth::User()->NhanVien->ChucVu;
        $this->chucvunv = ChucVu::where('ten', 'LIKE', '%Nhân viên%')->first();
    }

    function admin_index(){
        $this->data['title'] = "Danh sách hóa đơn";
        $this->data['title2'] = 'Danh sách hóa đơn (sử dụng + đã hủy)';
        $this->data['dshd'] = HoaDon::orderBy('id', 'desc')->paginate($this->paginate_set);
        $this->data['congdoan'] = CongDoan::orderBy('id', 'asc')->get();
        return view('admin.cdhd.admin_index', $this->data);
    }

    function admin_bt(){
        $this->data['title'] = "Danh sách hóa đơn có hiệu lực";
        $this->data['title2'] = 'Danh sách hóa đơn còn hiệu lực ';
        $this->data['dshd'] = HoaDon::where('dahuy', 0)->orderBy('id', 'desc')->paginate($this->paginate_set);
        $this->data['congdoan'] = CongDoan::orderBy('id', 'asc')->get();
        return view('admin.cdhd.admin', $this->data);
    }

    function admin_dahuy(){
        $this->data['title'] = "Danh sách hóa đơn đã hủy";
        $this->data['title2'] = 'Danh sách hóa đơn đã được hủy';
        $this->data['dshd'] = HoaDon::where('dahuy', 1)->orderBy('id', 'desc')->paginate($this->paginate_set);
        return view('admin.cdhd.admin_dahuy', $this->data);
    }
    
    function detail($id){
        $hd = HoaDon::find($id);
        if ($hd == null)
            return abort(404);
        $this->data['hd'] = $hd;
        $this->data['title'] = "Chi tiết hóa đơn";
        $this->data['title2'] = 'Hóa đơn #'.$hd->id;
        $this->data['congdoan'] = CongDoan::orderBy('id', 'asc')->get();
        return view('admin.cdhd.detail', $this->data);
    }
}

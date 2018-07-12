<?php

namespace App\Http\Controllers\Admin\XLHoaDon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChucVu;
use App\Models\CongDoanHoaDon;
use App\Models\HoaDon;
use App\Models\PhanCong;
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
        $dspc = PhanCong::select(DB::raw('hoadon_id, MAX(id) as id'))->groupBy('hoadon_id')->get();
        $ds_id_pc = [];
        foreach($dspc as $pc)
            if (HoaDon::find($pc->hoadon_id)->dahuy == 0)
                $ds_id_pc[] = $pc->id;
        $dspc = PhanCong::whereIn([
            ['id', $ds_id_pc],
            ['status', 1],
            ['nhanvien_id', Auth::User()->id]
        ])->get();

        $ds_id = [];
        foreach($dspc as $pc)
            $ds_id[] = $pc->id;
        return $ds_id;
    }
    //hoá đơn do phòng ban làm
    private function getHD_PB(){
        return $this->getDS_lastid_CDHD();
    }

    private function getDS_lastid_CDHD(){
        //chỉ lấy CD đã hoàn thành
        $dscdhd = CongDoanHoaDon::select(DB::raw('hoadon_id, MAX(id) as id'))
                                ->where([['status', 1], ['congdoan_id', $this->pb->CongDoan()->first()->id]])
                                ->groupBy('hoadon_id')->get();
        $ds_id_cdhd = [];
        foreach($dscdhd as $cdhd)
            if (HoaDon::find($cdhd->hoadon_id)->dahuy == 0)
                $ds_id_cdhd[] = $cdhd->id;
        return $ds_id_cdhd;
    }

    private function getInfo(){
        $this->pb = Auth::User()->NhanVien->PhongBan;
        $this->chucvu = Auth::User()->NhanVien->ChucVu;
        $this->chucvunv = ChucVu::where('ten', 'LIKE', '%Nhân viên%')->first();
    }
}

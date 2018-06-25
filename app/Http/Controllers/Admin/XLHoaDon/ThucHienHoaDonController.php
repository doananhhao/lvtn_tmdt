<?php

namespace App\Http\Controllers\Admin\XLHoaDon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ChucVu;
use App\Models\NhanVien;
use App\Models\CongDoanHoaDon;
use App\Models\CongDoan;
use App\Models\HoaDon;
use App\Models\PhanCong;
use DB;

class ThucHienHoaDonController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];
    private $pb = null;
    private $chucvu = null;

    function __construct(){
        $this->data['title'] = 'Quản lý hóa đơn - Nhân viên';
        $this->data['title2'] = 'Hóa đơn';
    }

    function index(){
        $this->getInfo();
        if ($this->chucvu->ten != "Nhân viên")
            return abort(404);
        $this->data['dspc'] = PhanCong::whereIn('id', $this->validatedDS_PC())->orderBy('id', 'desc')->paginate($this->paginate_set);;
        $this->data['title2'] = 'Hóa đơn cần xử lý: '.$this->pb->ten;
        return view('admin.hoa-don.nv_index', $this->data);
    }

    /**
     * ajax, get chi tiết phân công
     */
    function getPC(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Nhân viên"))
            return;
        $pc_id = $request->phancong_id;
        $pc = PhanCong::find($pc_id);

        if ($pc == null || $pc->HoaDon->PhanCong->sortByDesc('id')->first()->id != $pc->id ||
            $pc->NhanVien->PhongBan->CongDoan->first()->id != $pc->HoaDon->CongDoanHoaDon->sortByDesc('id')->first()->congdoan_id)
            return response()->json([
                'success' => false,
                'message' => 'Công việc này không tồn tại hoặc đã hoàn thành',
            ]);

        return response()->json([
            'success' => true,
            'comments' => $pc->comments ? $pc->comments : "",
        ]);
    }

    /**
     * ajax nhân viên báo cáo (hoàn thành or vấn đề) cho trưởng phòng (Lưu lại status và cmt vào $pc đó)
     */
    function setStatusPC(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Nhân viên"))
            return;
        
        $pc_id = $request->phancong_id;
        $comments = $request->comments;

        $pc = PhanCong::find($pc_id);

        if ($pc == null || $pc->HoaDon->PhanCong->sortByDesc('id')->first()->id != $pc->id ||
            $pc->NhanVien->PhongBan->CongDoan->first()->id != $pc->HoaDon->CongDoanHoaDon->sortByDesc('id')->first()->congdoan_id ||
            $pc->status == 1)
            return response()->json([
                'success' => false,
                'message' => 'Công việc này không tồn tại hoặc đã hoàn thành',
            ]);

        //comments bây giờ là là lời nhắn của nhân viên muốn gửi cho trưởng phòng (khi status = 1)
        $pc->comments = $comments;
        $pc->status = 1;
        $pc->save();

        return response()->json([
            'success' => true,
            'message' => "Gửi báo cáo công việc hóa đơn #".$pc->HoaDon->id." [".$this->pb->ten."] thành công!",
        ]);
    }

    //congdoan_id (phân công) == congdoan_id (công đoạn hóa đơn), với id mới nhất => ds_pc
    private function validatedDS_PC(){
        $dspc = $this->getDS_PC_NV();
        $ds_id_pc = [];
        foreach ($dspc as $pc){
            $cdhd = $pc->HoaDon->CongDoanHoaDon->sortByDesc('id')->first();
            if ($cdhd->congdoan_id == $pc->NhanVien->PhongBan->CongDoan->sortByDesc('id')->first()->id)
                $ds_id_pc[] = $pc->id;
        }
        $dspc = PhanCong::whereIn('id', $ds_id_pc)->get();
        return $ds_id_pc;
    }

    //Lấy DS PHÂN CÔNG của nhân viên này 
    //(điều kiện: id phân công mới nhất của hóa đơn, có nhanvien_id = của nhân viên, status = 0 chưa báo cáo)
    private function getDS_PC_NV(){
        $ds_id_pc = $this->getDS_lastid_PC();
        $nhanvien_id = Auth::User()->id;
        $dspc = PhanCong::where('nhanvien_id', $nhanvien_id)
                        ->where('status', 0)
                        ->whereIn('id', $ds_id_pc)->get();
        return $dspc;
    }

    //Các phân công mới nhất của mỗi hóa đơn
    private function getDS_lastid_PC(){
        $dspc = PhanCong::select(DB::raw('hoadon_id, MAX(id) as id'))->groupBy('hoadon_id')->get();
        $ds_id_pc = [];
        foreach($dspc as $pc)
            if (HoaDon::find($pc->hoadon_id)->dahuy == 0)
                $ds_id_pc[] = $pc->id;
        return $ds_id_pc; //danh sách id phân công mới nhất của mỗi hóa đơn
    }

    private function getInfo(){
        $this->pb = Auth::User()->NhanVien->PhongBan;
        $this->chucvu = Auth::User()->NhanVien->ChucVu;
    }
}

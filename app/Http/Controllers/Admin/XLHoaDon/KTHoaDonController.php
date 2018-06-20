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

class KTHoaDonController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];
    private $pb = null;
    private $dsnv = null;
    private $chucvu = null;
    private $ds_id_cdhd = [];
    private $ds_id_cdhd_xulylai = []; //id các công đoạn PB (của công đoạn tiếp theo) trả lại để xử lý lại

    function __construct(){
        $this->data['title'] = 'Quản lý hóa đơn';
        $this->data['title2'] = 'Hóa đơn';
    }

    function index(){
        $this->getInfo();
        if ($this->chucvu->ten == "Nhân viên")
            return abort(404);
        $this->getDS_id_CDHD_XuLyLai();
        $this->data['cdhd'] = CongDoanHoaDon::whereIn('id', $this->ds_id_cdhd)
                                            ->whereNotIn('id', $this->ds_id_cdhd_xulylai)
                                            ->orderBy('id', 'desc')
                                            ->paginate($this->paginate_set);
        $this->data['phongban'] = $this->pb;
        $this->data['title2'] = 'Hóa đơn mới: '.$this->pb->ten;
        return view('admin.hoa-don.index', $this->data);
    }
    //Hóa đơn xử lý lại
    function index2(){
        $this->getInfo();
        if ($this->chucvu->ten == "Nhân viên")
            return abort(404);
        $this->getDS_id_CDHD_XuLyLai();
        $this->data['cdhd'] = CongDoanHoaDon::whereIn('id', $this->ds_id_cdhd_xulylai)
                                            ->orderBy('id', 'desc')
                                            ->paginate($this->paginate_set);
        $this->data['phongban'] = $this->pb;
        $this->data['title2'] = 'Hóa đơn cần xử lý lại: '.$this->pb->ten;
        return view('admin.hoa-don.index', $this->data);
    }
    //Hóa đơn đã được phân công công đoạn này
    function index3(){
        $this->getInfo();
        if ($this->chucvu->ten == "Nhân viên")
            return abort(404);
        $this->getDS_id_CDHD_XuLyLai();
        //
        $ds_cdhd = CongDoanHoaDon::whereIn('id', $this->ds_id_cdhd)->get();
        $ds_id_daphancong = [];
        foreach ($ds_cdhd as $v)
            if ($v->HoaDon->PhanCong->sortByDesc('id')->first() != null &&
                $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $v->congdoan_id)
                $ds_id_daphancong[] = $v->id;
        //
        $this->data['cdhd'] = CongDoanHoaDon::whereIn('id', $ds_id_daphancong)
                                            ->whereNotIn('id', $this->ds_id_cdhd_xulylai)
                                            ->orderBy('id', 'desc')
                                            ->paginate($this->paginate_set);
        $this->data['phongban'] = $this->pb;
        $this->data['title2'] = 'Hóa đơn đã được phân công (không gồm HD bị phản hồi): '.$this->pb->ten;
        return view('admin.hoa-don.index', $this->data);
    }
    //Hóa đơn nhân viên đã làm xong và chờ xét lại (Status phân công = 1)
    function index4(){
        $this->getInfo();
        if ($this->chucvu->ten == "Nhân viên")
            return abort(404);
            $this->getDS_id_CDHD_XuLyLai();
        //
        $ds_cdhd = CongDoanHoaDon::whereIn('id', $this->ds_id_cdhd)->get();
        $ds_id_dahoanthanhpc = [];
        foreach ($ds_cdhd as $v)
            if ($v->HoaDon->PhanCong->sortByDesc('id')->first() != null &&
                $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $v->congdoan_id &&
                $v->HoaDon->PhanCong->sortByDesc('id')->first()->status == 1)
                $ds_id_dahoanthanhpc[] = $v->id;
        //
        $this->data['cdhd'] = CongDoanHoaDon::whereIn('id', $ds_id_dahoanthanhpc)
                ->orderBy('id', 'desc')
                ->paginate($this->paginate_set);
        $this->data['phongban'] = $this->pb;
        $this->data['title2'] = 'Hóa đơn đã hoàn thành phân công: '.$this->pb->ten;
        return view('admin.hoa-don.index', $this->data);
    }
    /**
     * ajax đánh dấu hoàn thành công đoạn hóa đơn
     */
    function hoanthanhCongDoanHoaDon(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Trưởng phòng"))
            return;
        $hoadon_id = $request->hoadon_id;
        $hd = HoaDon::find($hoadon_id);
        //hoadon_id sai hoặc không tồn tại trong db
        if ($hd == null)
            return response()->json([
                'success' => false,
                'message' => 'Mã hóa đơn không đúng',
            ]);
        $cdhd = $hd->CongDoanHoaDon->sortByDesc('id')->first();
        //cdhd có status == false hoặc có công đoạn HIỆN TẠI khác với phòng ban của Auth::user() thì báo lỗi
        if ($cdhd->status != false || $cdhd->congdoan_id != $this->pb->CongDoan()->first()->id)
            return response()->json([
                'success' => false,
                'message' => 'Hóa đơn không thuộc hoặc đã hoàn thành công đoạn này',
            ]);
        //Nhân viên phải đã làm xong công đoạn này (PC mới nhất có status = 1) để chờ TP kiểm tra
        //và congdoan_id của CDHD mới nhất của HD này phải = với của Auth::user()->nv->pb->cd->id
        //Nếu ko báo lỗi
        if (!($hd->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $cdhd->congdoan_id &&
            $hd->PhanCong->sortByDesc('id')->first()->status == 1)){
                return response()->json([
                    'success' => false,
                    'message' => 'Hóa đơn không thuộc hoặc đã hoàn thành công đoạn này',
                ]);
            }
        $cdhd->status = 1;
        $cdhd->save();
        $cd_sau = $cdhd->CongDoan->CongDoanSau;
        if ($cd_sau != null){
            $hd->CongDoanHoaDon()->create([
                'congdoan_id' => $cd_sau->id,
                'truongphong_id' => $cd_sau->PhongBan->truongphong_id
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái hoàn thành công đoạn ['.$cdhd->congdoan_id.'] ['.$this->pb->ten.'] cho hóa đơn #'.$hoadon_id,
        ]);
    }
    /**
     * ajax phản hồi hóa đơn cho phòng ban trước đó
     */
    function xllHoaDon(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Trưởng phòng"))
            return;
        if ($this->pb->ten == "Phòng kiểm tra")
            return response()->json([
                'success' => false,
                'message' => 'Trưởng phòng [Phòng kiểm tra] không được sử dụng chức năng này',
            ]);
        $hoadon_id = $request->hoadon_id;
        $hd = HoaDon::find($hoadon_id);
        if ($hd == null)
            return response()->json([
                'success' => false,
                'message' => 'Mã hóa đơn không đúng',
            ]);
        $cdhd = $hd->CongDoanHoaDon->sortByDesc('id')->first();
        if ($cdhd->status != false || $cdhd->congdoan_id != $this->pb->CongDoan()->first()->id)
            return response()->json([
                'success' => false,
                'message' => 'Hóa đơn không thuộc công đoạn này',
            ]);
        //Khi yêu cầu xử lý lại, thì trạng thái công việc TRƯỚC ĐÓ so với công đoạn hóa đơn cb sửa đều bằng status = 0 (công việc nv làm)
        $pc = $hd->PhanCong->sortByDesc('id')->first();
        $pc->status = 0;
        $pc->save();
        //Đưa công đoạn hiện tại của công việc về công đoạn trước đó
        $pb_truoc = $cdhd->CongDoan->CongDoanTruoc->PhongBan;
        $hd->CongDoanHoaDon()->create([
            'congdoan_id' => $cdhd->CongDoan->FK_congdoantruoc,
            'truongphong_id' => $pb_truoc->truongphong_id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Đã gửi yêu cầu xử lý đơn đặt hàng #'.$hoadon_id.' cho ['.$pb_truoc->ten.'] thành công',
        ]);
    }

    /**
     * ajax hủy hóa đơn CHỈ [phòng kiểm tra]
     */
    function huyHoaDon(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Trưởng phòng"))
            return;
        if ($this->pb->ten != "Phòng kiểm tra")
            return response()->json([
                'success' => false,
                'message' => 'Chỉ có trưởng phòng [Phòng kiểm tra] mới được sử dụng chức năng này',
            ]);
        $hoadon_id = $request->hoadon_id;
        $hd = HoaDon::find($hoadon_id);
        if ($hd == null)
            return response()->json([
                'success' => false,
                'message' => 'Mã hóa đơn không đúng',
            ]);
        $hd->dahuy = 1;
        $hd->save();
        return response()->json([
            'success' => true,
            'message' => 'Hủy đơn đặt hàng #'.$hoadon_id.' thành công',
        ]);
    }
    /**
     * ajax idhd_idcdhd
     */
    function getPCNV(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Trưởng phòng"))
            return;
        $arr_id = explode('_', $request->id);
        $cdhd = HoaDon::find($arr_id[0])->CongDoanHoaDon->sortByDesc('id')->first();
        //Nếu cdhd_id không còn là id mới nhất của hd_id này
        if ($arr_id[1] != $cdhd->id){
            return response()->json([
                'success' => false,
                'message' => 'Công đoạn hóa đơn bạn đang phân công đã không phải công đoạn hiện tại của hóa đơn',
            ]);
        }
        $return = [
            'success' => true,
        ];
        foreach ($this->dsnv as $nv)
            $return['dsnv'][$nv->nhanvien_id] = $nv->User->name;
        $pc = $this->getPhanCong($arr_id[0]);
        if ($pc){
            $return['selected'] = $pc->nhanvien_id;
            $return['comments'] = $pc->comments;
        }
        return response()->json($return);
    }
    // ajax idnv, cmt, idhd_idcdhd [Phân công nv]
    function setPCNV(Request $request){
        $this->getInfo();
        if (!(Auth::User()->LoaiUser->tenloai == "Nhân viên" && $this->chucvu->ten == "Trưởng phòng"))
            return;
        $nhanvien_id = $request->id_nv;
        $comments = $request->cmt;
        $arr_id = explode('_', $request->idhd_idcdhd);
        //xét nv có thuộc pb này ko
        if ($this->dsnv->where('nhanvien_id', $nhanvien_id)->first() == null)
            return response()->json([
                'success' => false,
                'message' => 'Nhân viên được phân công không thuộc phòng ban này',
            ]);
        //xét hoadon_id có tồn tại ko
        $hd = HoaDon::find($arr_id[0]);
        if ($hd == null)
            return response()->json([
                'success' => false,
                'message' => 'Không tồn tại hóa đơn này',
            ]);
        //xét hoadon_id có hợp lệ ko (hoadon có CD = FALSE và congdoan = pb này)
        $cdhd = CongDoanHoaDon::where('hoadon_id', $arr_id[0])->orderBy('id','desc')->first();
        if (!($cdhd->status == 0 && $cdhd->congdoan_id == $this->pb->CongDoan()->first()->id) || 
            (CongDoanHoaDon::find($arr_id[1])->id != $cdhd->id))
            return response()->json([
                'success' => false,
                'message' => 'Hóa đơn đang phân công không thuộc phòng ban này HOẶC đã hoàn thành công đoạn này',
            ]);
        //xét pc mới nhất của hd này có phải nv này ko, lấy cùng công đoạn phân công hiện tại
        //  true: cập nhật comments
        //  false: thêm mới
        //status luôn = 0 khi save()
        $pc = $this->getPhanCong($arr_id[0]);
        $return = [
            'success' => true
        ];
        //Chỉ cập nhật lại cmt nếu nếu đã pc nv này cv cb pc
        if ($pc != false && $pc->nhanvien_id == $nhanvien_id){
            $pc->comments = $comments;
            $pc->status = 0;
            $pc->save();
            $return['message'] = 'Đã cập nhật thành công';
        }else{
            if ($pc != false){
                $pc->status = 0;
                $pc->save();
            }
            $hd->PhanCong()->create([
                'nhanvien_id' => $nhanvien_id,
                'comments' => $comments ? $comments : "",
                'status' => 0
            ]);
            $return['message'] = 'Đã phân công nhân viên ['.NhanVien::find($nhanvien_id)->User->name.'] xử lý hóa đơn #'.$hd->id;
        }
        return response()->json($return);
    }
    /**
     * @param $hoadon_id
     * So sánh CDHD có id mới nhất và PC có id mới nhất của hoadon_id có cùng 1 công đoạn không
     * Nếu true: trả về object PhanCong của hoadon_id đó
     * Nếu false: trả về false
     */
    private function getPhanCong($hoadon_id = null){
        $hd = HoaDon::find($hoadon_id);
        if ($hd == null)
            return false;
        if ($hd->PhanCong->sortByDesc('id')->first() != null &&
            $hd->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $hd->CongDoanHoaDon->sortByDesc('id')->first()->congdoan_id)
        {
            return $hd->PhanCong->sortByDesc('id')->first();
        }else return false;
    }

    /**
     * LIST những CDHD (id mới nhất theo Hóa đơn) có CongDoan_id FK_congdoansau đã tồn tại
     */
    private function getDS_id_CDHD_XuLyLai(){
        // $cd_cuoi = CongDoan::whereNull('FK_congdoansau')->first();

        $dscdhd = $this->getDS_CDHD();
        $ds_id_cdhd_xulylai = [];

        foreach ($dscdhd as $cdhd){
            $cd_sau = $cdhd->CongDoan->FK_congdoansau;
            $cdhd_cancheck = CongDoanHoaDon::where([
                ['hoadon_id', $cdhd->hoadon_id],
                ['congdoan_id', $cd_sau]
            ])->orderBy('id','desc')->first();

            if ($cdhd_cancheck != null)
                $ds_id_cdhd_xulylai[] = $cdhd->id;
        }

        $this->ds_id_cdhd_xulylai = $ds_id_cdhd_xulylai;
        return $ds_id_cdhd_xulylai;
    }

    /**
     * Lấy LIST congdoanhoadon cần xử lý tại phòng ban này
     * 
     * DK: record mới nhất thuộc hoadon_id và có status = FALSE
     * $status = 0: công đoạn đang cần xử lý
     */
    private function getDS_CDHD($status = 0){
        $ds_id_cdhd = $this->getDS_lastid_CDHD();
        $dscdhd = CongDoanHoaDon::whereIn('id', $ds_id_cdhd)->where([
            ['congdoan_id', $this->pb->CongDoan()->first()->id],
            ['status', $status]
        ])->get();
        $this->ds_id_cdhd = $this->convertToIdArray($dscdhd);
        return $dscdhd;
    }

    private function getDS_lastid_CDHD(){
        $dscdhd = CongDoanHoaDon::select(DB::raw('hoadon_id, MAX(id) as id'))->groupBy('hoadon_id')->get();
        $ds_id_cdhd = [];
        foreach($dscdhd as $cdhd)
            if (HoaDon::find($cdhd->hoadon_id)->dahuy == 0)
                $ds_id_cdhd[] = $cdhd->id;
        // $ds_id_cdhd = $this->convertToIdArray($dscdhd);
        return $ds_id_cdhd;
    }

    private function convertToIdArray($arr = array()){
        $ds_id = [];
        foreach ($arr as $v)
            $ds_id[]= $v->id;
        return $ds_id;
    }

    private function getInfo(){
        $this->pb = Auth::User()->NhanVien->PhongBan;
        $this->chucvu = Auth::User()->NhanVien->ChucVu;
        $chucvunv = ChucVu::where('ten', 'LIKE', '%Nhân viên%')->first();
        $this->dsnv = NhanVien::where('phongban_id', $this->pb->id)->where('chucvu_id', $chucvunv->id)->get();
    }
}

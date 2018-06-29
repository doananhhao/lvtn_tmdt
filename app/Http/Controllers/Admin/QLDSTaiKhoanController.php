<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\User;
use App\Models\LoaiUser;
use App\Models\PhongBan;
use App\Models\NhanVien;
use App\Models\ChucVu;

class QLDSTaiKhoanController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];

    function __construct(){
        $this->data['title'] = "Quản lý các tài khoản";
        $this->data['title2'] = 'Danh sách tài khoản';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loaiuser_id = null;
        $trangthai = null;
        if ($request->has('loaiuser'))
            $loaiuser_id = $request->loaiuser;
        if ($request->has('status'))
            $trangthai = $request->status;

        $users = null;

        if ($loaiuser_id == null){
            if ($trangthai != null){
                if (in_array($trangthai, [0, 1]))
                    $users = User::where('trangthai', $trangthai)->orderBy('id', 'desc');
            }
        }else{
            if (!LoaiUser::find($loaiuser_id) == null)
                if ($trangthai != null){
                    if (in_array($trangthai, [0, 1])){
                        $users = User::where([['loaiuser_id', $loaiuser_id], ['trangthai', $trangthai]])
                                        ->orderBy('id', 'desc');
                    }
                }else
                    $users = User::where('loaiuser_id', $loaiuser_id)->orderBy('id', 'desc');
        }
        if ($users == null)
            $users = User::orderBy('id', 'desc');
        
        //
        // $loai_admin = Auth::User()->LoaiUser;
        // $users->whereNotIn('loaiuser_id', [$loai_admin->id]);
        //

        if (LoaiUser::where('tenloai', 'LIKE', '%Nhân viên%')->first()->id == $loaiuser_id){
            $phongban_id = null;
            if ($request->has('phongban'))
                $phongban_id = $request->phongban;
            $phongban = PhongBan::find($phongban_id);
            if ($phongban != null)
                $users = $phongban->NhanVien()->orderBy('nhanvien_id','desc');
            else
                $users = NhanVien::orderBy('nhanvien_id','desc');
            if ($trangthai != null)
                if (in_array($trangthai, [0, 1])){
                    $ds_id = [];    //danh sách id của tất cả nhân viên hợp lệ (chưa tính status)
                    foreach ($users->get() as $nv){
                        $ds_id[] = $nv->nhanvien_id;
                    }
                    $users = User::where('trangthai', $trangthai)->whereIn('id', $ds_id)->get();
                    $ds_id = [];    //danh sách id của tất cả nhân viên hợp lệ + đã tính status
                    foreach ($users as $user){
                        $ds_id[] = $user->id;
                    }
                    $users = NhanVien::whereIn('nhanvien_id', $ds_id)->orderBy('nhanvien_id','desc');
                }
        }
        
        $this->data['loaiuser'] = LoaiUser::all();
        $this->data['users'] = $users->paginate($this->paginate_set)->appends(request()->query());

        $this->data['phongban'] = PhongBan::all();
        return view('admin/tai-khoan/index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['chucvu'] = ChucVu::all();
        $this->data['phongban'] = PhongBan::all();
        $this->data['loaiuser'] = LoaiUser::where('tenloai', 'NOT LIKE', '%Người dùng%')->get();
        $this->data['title2'] = "Thêm tài khoản mới";
        return view('admin/tai-khoan/create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'loaiuser' => [
                'required',
                Rule::exists('loaiuser', 'id')->where(function ($query){
                    return $query->where('tenloai', 'NOT LIKE', '%Người dùng%');
                }),
            ],
            // 'chucvu' => 'required|exists:chucvu,id',
            'phongban' => 'required|exists:phongban,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'loaiuser_id' => $request->loaiuser,
        ]);

        if (LoaiUser::find($request->loaiuser)->tenloai == "Nhân viên")
            // $this->user_nhanvien($user, $request->chucvu);
            if ($this->user_nhanvien($user, $request->phongban))    //chức vụ là nhân viên vì 1 pb có 1 tp
            {
                $success = "Bạn đã thêm thành công [NHÂN VIÊN] mới";
            }
        
        return back()->with('success', $success ? $success :'Bạn đã thêm thành công')->withInput();
    }

    private function user_nhanvien($user = null, $phongban_id = null){
        // if ($user == null || $chucvu == null) return false;
        if ($user == null || $phongban_id == null) return false;
        
        $chucvu = ChucVu::where('ten', 'LIKE', '%Nhân Viên%')->first();
        $nhanvien = $user->NhanVien()->create([
            'phongban_id' => $phongban_id,
            'chucvu_id' => $chucvu->id
        ]);

        return $nhanvien;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ajax: đổi status user
     */
    function change_user_status(Request $request){
        if (!$request->ajax())
            return;
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if ($user == null)
            return response()->json([
                'success' => false,
                'message' => 'Mã tài khoản không đúng',
            ]);
        
        if ($user->NhanVien != null)
            if ($user->NhanVien->ChucVu->ten == "Trưởng phòng")
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể thay đổi trạng thái của tài khoản [TRƯỞNG PHÒNG]',
                ]);
        
        if ($user->trangthai == 0)
            $user->trangthai = 1;
        else $user->trangthai = 0;

        $user->save();

        return response()->json([
            'success' => true,
            'status' => $user->trangthai,
            'message' => 'Đã đổi trạng thái tài khoản ['.$user->email.'] thành ['.($user->trangthai == 1 ? "HOẠT ĐỘNG": "TẠM KHÓA").']',
        ]);
    }
    /**
     * ajax: lấy thông tin pb và cv nhân viên
     */
    function get_nv(Request $request){
        if (!$request->ajax())
            return;
        $nv = NhanVien::find($request->nhanvien_id);
        if ($nv == null)
            return response()->json([
                'success' => false,
                'message' => 'Mã nhân viên không hợp lệ',
            ]);
        
        return response()->json([
            'success' => true,
            'pb' => PhongBan::all(),
            'chucvu' => ChucVu::all(),
            'selected_pb' => $nv->PhongBan->id,
            'selected_cv' => $nv->ChucVu->id
        ]);
    }
    /**
     * ajax: đổi phòng ban và chức vu nv
     */
    function change_nv(Request $request){
        if (!$request->ajax())
            return;
        $nhanvien = NhanVien::find($request->nhanvien_id);
        $phongban = PhongBan::find($request->phongban_id);
        $chucvu = ChucVu::find($request->chucvu_id);

        if ($nhanvien == null || $phongban == null || $chucvu == null)
            return response()->json([
                'success' => false,
                'message' => '[id] dữ liệu đã bị thay đổi, không hợp lệ',
            ]);
        
        if ($nhanvien->ChucVu->ten == "Trưởng phòng")
            return response()->json([
                'success' => false,
                'message' => 'Phòng Ban không thể trống [Trưởng Phòng], chọn [Trưởng Phòng] khác sẽ tự chuyển chức vụ thành [Nhân Viên]',
            ]);

        if ($nhanvien->User->trangthai == 0)
            return response()->json([
                'success' => false,
                'message' => 'Không được thực hiện trên tài khoản [TẠM KHÓA]',
            ]);

        if ($nhanvien->PhongBan->id == $phongban->id){
            //đổi chức vụ thành tp
            if ($chucvu->id != $nhanvien->ChucVu->id){
                $old_tp = $this->doi_tp_id_pb($phongban, $nhanvien, $chucvu, false);
            }
        }else{  //đổi sang pb khác
            //đổi chức vụ thành tp
            if ($chucvu->id != $nhanvien->ChucVu->id){
                $old_tp = $this->doi_tp_id_pb($phongban, $nhanvien, $chucvu, true);
            }else{
                //đổi pb nhưng chức vụ là nv
                $nhanvien->phongban_id = $phongban->id;
                $nhanvien->save();
            }
        }
        
        $nhanvien = NhanVien::find($request->nhanvien_id);
        $class = [
            1 => 'label label-primary',
            2 => 'label label-success',
        ];
        $return = [
            'success' => true,
            'current_pb' => $nhanvien->PhongBan->ten,
            'current_cv' => $nhanvien->ChucVu->ten,
            'class_nv' => $class[2],
            'class_tp' => $class[1],
        ];
        if (isset($old_tp))
            if ($old_tp != null){
                $return['old_tp'] = $old_tp->nhanvien_id;
            }
        return response()->json($return);
    }

    private function doi_tp_id_pb($phongban, $nhanvien, $chucvu, $doipb = false){
        //đổi tp_id cho phòng ban thành $nhanvien và tp_cũ thành nv
        $old_tp = $phongban->TruongPhong;
        if ($old_tp != null){
            //tp cũ thành nv
            $old_tp->chucvu_id = $nhanvien->ChucVu->id;
            $old_tp->save();
        }
        //khác
        foreach ($phongban->NhanVien as $nv){
            if ($nv->chucvu_id == 1){
                $nv->chucvu_id = 2;
                $nv->save();
            }
        }
        //khác
        //đổi tp_id trong pb
        $phongban->truongphong_id = $nhanvien->nhanvien_id;
        $phongban->save();

        if ($doipb == true){
            //đổi chucvu nv thành tp và đổi pb
            $nhanvien->phongban_id = $phongban->id;
            $nhanvien->chucvu_id = $chucvu->id;
            $nhanvien->save();
        }else{
            //đổi chucvu nv thành tp
            $nhanvien->chucvu_id = $chucvu->id;
            $nhanvien->save();
        }
        
        return $old_tp;
    }
}

<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoaiSP;
use App\Models\SanPham;
use App\Models\BinhLuan;

class BinhLuanController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];

    function __construct(){
        $this->data['title'] = 'Duyệt bình luận của người dùng';
        $this->data['title2'] = 'Danh sách các bình luận Sản Phẩm Chính';
    }

    function index(Request $request){
        /**
         * null: hiển thị tất cả
         * 0:    hiển thị chưa duyệt
         * 1:    hiển thị đã duyệt
         */
        $tinhtrang = null;
        $sanpham_id = null;

        if ($request->has('tinhtrang'))
            $tinhtrang = $request->get('tinhtrang');
        if ($request->has('sanpham'))
            $sanpham_id = $request->get('sanpham');

        if ($sanpham_id != null && SanPham::find($sanpham_id) == null)
            return abort(404);
        if (SanPham::find($sanpham_id) != null)
            if (SanPham::find($sanpham_id)->DangBan()->first() != null) //đăng bán không cần duyệt bình luận
                return abort(404);

        if ($tinhtrang == null){
            if ($sanpham_id == null)
                $bl = BinhLuan::orderBy('id', 'desc')->paginate($this->paginate_set);
            else $bl = BinhLuan::where('sanpham_id', $sanpham_id)->orderBy('id', 'desc')->paginate($this->paginate_set);
        }else{
            if ($sanpham_id == null)
                $bl = BinhLuan::where('status', $tinhtrang)->orderBy('id', 'desc')->paginate($this->paginate_set);
            else $bl = BinhLuan::where([['status', $tinhtrang], ['sanpham_id', $sanpham_id]])->orderBy('id', 'desc')->paginate($this->paginate_set);
        }

        $bl->appends(request()->query());
        $this->data['binhluan'] = $bl;
        $this->data['loaisp'] = LoaiSP::all();
        return view('admin.binh-luan.index', $this->data);
    }

    function changeTinhTrang(Request $request){
        if (!$request->ajax() || $request->id == null || $request->status == null)
            return response()->json([
                'success' => false,
                'message' => 'Không nhận được dữ liệu'
            ]);
        $binhluan = BinhLuan::find($request->id);
        if ($binhluan == null || !in_array($request->status, [0,1]))
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ'
            ]);
        
        if ($binhluan->status == $request->status)
            return response()->json([
                'success' => false,
                'message' => "Trạng thái này đã được thay đổi bởi người khác. Xin Load lại trang"
            ]);

        $binhluan->status = $request->status;
        $binhluan->save();

        return response()->json([
            'success' => true,
            'checked' => $binhluan->status == 1 ? true : false,
            'message' => 'Trạng thái bình luận [#'.$binhluan->id.'] đã được đổi thành'.($binhluan->status == 1 ? ' [cho phép hiển thị]': ' [không được phép hiển thị]')
        ]);
    }
}

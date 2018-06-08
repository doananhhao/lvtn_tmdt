<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DangBan;
use App\Models\SanPham;
use App\Models\LoaiSP;

class DangBanController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];

    function __construct(){
        $this->data['title'] = 'Duyệt sản phẩm đăng bán của người dùng';
        $this->data['title2'] = 'Danh sách các yêu cầu đăng bán';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->data['search'] = 1;
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
        // if (($sanpham_id != null && DangBan::where('sanpham_id', $sanpham_id)->first() == null) || ($tinhtrang != null && DangBan::where('tinhtrang', $tinhtrang)->first() == null))
        if ($sanpham_id != null && SanPham::find($sanpham_id) == null)
            return abort(404);

        if ($tinhtrang == null){
            if ($sanpham_id == null)
                $dangban = DangBan::orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dangban = DangBan::where('sanpham_id', $sanpham_id)->orderBy('created_at', 'desc')->paginate($this->paginate_set);
        }else{
            if ($sanpham_id == null)
                $dangban = DangBan::where('tinhtrang', $tinhtrang)->orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dangban = DangBan::where([['tinhtrang', $tinhtrang], ['sanpham_id', $sanpham_id]])->orderBy('created_at', 'desc')->paginate($this->paginate_set);
        }
        $dangban->appends(request()->query());
        $this->data['dangban'] = $dangban;
        $this->data['loaisp'] = LoaiSP::all();
        return view('admin.dang-ban.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if (DangBan::find($id) == null)
            return abort(404);
        $dangban = DangBan::find($id);
        $this->data['dangban'] = $dangban;
        $this->data['title2'] = 'Chi tiết thông tin mô tả';
        return view('admin.dang-ban.edit', $this->data);
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
        if (DangBan::find($id) == null)
            return abort(404);
        
        $this->validate($request, [
            'mota' => 'required|max:10000',
        ]);

        $duyet = $request->duyet == 1 ? 1 : 0;

        $dangban = DangBan::find($id);
        $dangban->mota = $request->mota;
        $dangban->tinhtrang = $duyet;
        $dangban->save();
        
        return back()->with('success', 'Bạn đã cập nhật thành công')->withInput();
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
     * ajax
     */
    function changeTinhTrang(Request $request){
        if (!$request->ajax() || $request->id == null)
            return response()->json(['success' => false]);
        
        $dangban = DangBan::find($request->id);
        $tt = $request->tinhtrang == 1 ? 1 : 0;
        if ($dangban == null)
            return response()->json(['success' => false]);
        if ($tt == $dangban->tinhtrang)
            return response()->json(['success' => false]);
        
        $dangban->tinhtrang = $tt;
        $dangban->save();
        $return = [
            'success' => true,
            'checked' => $tt == 1 ? true : false
        ];
        return response()->json($return);
    }
}

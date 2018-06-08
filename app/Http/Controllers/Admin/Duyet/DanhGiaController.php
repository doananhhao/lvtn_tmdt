<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use App\Models\SanPham;
use App\Models\LoaiSP;
class DanhGiaController extends Controller
{
    //quản lý số trang
    private $paginate_set = 15;
    private $data = [];

    function __construct(){
        $this->data['title'] = 'Duyệt đánh giá sản phẩm của người dùng';
        $this->data['title2'] = 'Danh sách các đánh giá';
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
        // if (($sanpham_id != null && DanhGia::where('sanpham_id', $sanpham_id)->first() == null) || ($tinhtrang != null && DanhGia::where('tinhtrang', $tinhtrang)->first() == null))
        if ($sanpham_id != null && SanPham::find($sanpham_id) == null)
            return abort(404);

        if ($tinhtrang == null){
            if ($sanpham_id == null)
                $dg = DanhGia::orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dg = DanhGia::where('sanpham_id', $sanpham_id)->orderBy('created_at', 'desc')->paginate($this->paginate_set);
        }else{
            if ($sanpham_id == null)
                $dg = DanhGia::where('tinhtrang', $tinhtrang)->orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dg = DanhGia::where([['tinhtrang', $tinhtrang], ['sanpham_id', $sanpham_id]])->orderBy('created_at', 'desc')->paginate($this->paginate_set);
        }
        $dg->appends(request()->query());
        $this->data['dg'] = $dg;
        $this->data['loaisp'] = LoaiSP::all();
        return view('admin.danh-gia.index', $this->data);
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
    public function show($id_tv, $id_sp)
    {
        $dg = DanhGia::find($id_tv, $id_sp);
        if ($dg == null)
            return abort(404);
        $this->data['title2'] = 'Xem đánh giá';
        $this->data['dg'] = $dg;
        return view('admin.danh-gia.show', $this->data);
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
     * ajax
     */
    function changeTinhTrang(Request $request){
        if (!$request->ajax() || $request->id_tv == null || $request->id_sp == null)
            return response()->json(['success' => false]);
        
        $dg = DanhGia::find($request->id_tv, $request->id_sp);
        $tt = $request->tinhtrang == 1 ? 1 : 0;
        if ($dg == null)
            return response()->json(['success' => false]);
        if ($tt == $dg->tinhtrang)
            return response()->json(['success' => false]);
        
        $dg->tinhtrang = $tt;
        $dg->save();
        $return = [
            'success' => true,
            'checked' => $tt == 1 ? true : false
        ];
        return response()->json($return);
    }
}

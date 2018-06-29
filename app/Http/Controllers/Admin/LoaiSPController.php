<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\LoaiSP;
use App\Models\SanPham;
use App\Models\DangBan;

class LoaiSPController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = "Quản lý Loại sản phẩm";
        $this->data['title2'] = 'Loại sản phẩm';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['loaisp'] = LoaiSP::orderBy('id', 'desc')->paginate(15);
        $this->data['title2'] = 'Danh sách loại sản phẩm';
        return view('admin.loaisp.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title2'] = 'Thêm loại sản phẩm';
        return view('admin.loaisp.create', $this->data);
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
            'tenloai' => 'required|between:3,191|unique:loaisp,tenloai',
            'classfaicon' => 'max:200'
        ]);

        LoaiSP::create([
            'tenloai' => $request->tenloai,
            'classfaicon' => $request->classfaicon
        ]);
        return back()->with('success', 'Bạn đã thêm thành công '.$request->ten)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (LoaiSP::find($id) == null)
            return abort(404);
        $ds_id_db = [];
        foreach (DangBan::select('sanpham_id','id')->groupBy('id')->get() as $db)
            $ds_id_db[] = $db->sanpham_id;
        $loaisp = LoaiSP::find($id);
        // $this->data['dssp'] = $loaisp->SanPham()->orderBy('id', 'desc')->paginate(15);
        $this->data['dssp'] = SanPham::where('loaisp_id', $id)->whereNotIn('id', $ds_id_db)->orderBy('id', 'desc')->paginate(15);
        $this->data['title2'] = $loaisp->tenloai;
        return view('admin.sanpham.index', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (LoaiSP::find($id) == null)
            return abort(404);
        $this->data['loaisp'] = LoaiSP::find($id);
        $this->data['title2'] = 'Loại sản phẩm: '.LoaiSP::find($id)->tenloai;
        return view('admin.loaisp.edit', $this->data);
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
        if (LoaiSP::find($id) == null)
            return abort(404);
        $this->validate($request, [
            'tenloai' => [
                'required',
                'between:3,191',
                Rule::unique('loaisp', 'tenloai')->ignore($id),
            ],
            'classfaicon' => 'max:200'
        ]);
        $loaisp = LoaiSP::find($id);
        $loaisp->tenloai = $request->tenloai;
        $loaisp->classfaicon = $request->classfaicon;
        $loaisp->save();

        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tenloai)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (LoaiSP::find($id) == null)
            return abort(404);
        $loaisp = LoaiSP::find($id);
        $ten = $loaisp->tenloai;
        if (count($loaisp->SanPham) != 0)
            return back()->with('fail', 'Có sản phẩm đã được lưu bởi nhà cung cấp '.$ten.' nên tạm thời không thể xóa');
        $loaisp->delete();
        return back()->with('success', 'Đã xóa '.$ten.' thành công');
    }
}
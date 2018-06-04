<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\LoaiKhuyenMai;

class LoaiKhuyenMaiController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = "Quản lý loại khuyến mãi";
        $this->data['title2'] = 'Loại khuyến mãi';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title2'] = 'Danh sách loại khuyến mãi';
        $this->data['loaikm'] = LoaiKhuyenMai::orderBy('id', 'desc')->paginate(15);
        return view('admin.loai-khuyen-mai.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title2'] = 'Thêm loại khuyến mãi';
        return view('admin.loai-khuyen-mai.create', $this->data);
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
            'tenkhuyenmai' => 'required|between:3,191|unique:loaikhuyenmai,tenkhuyenmai',
            'mota' => 'max:10000',
        ]);

        LoaiKhuyenMai::create([
            'tenkhuyenmai' => $request->tenkhuyenmai,
            'mota' => $request->mota
        ]);

        return back()->with('success', 'Bạn đã thêm thành công '.$request->tenkhuyenmai)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('loai-khuyen-mai.chi-tiet-khuyen-mai.index', ['loai_khuyen_mai' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (LoaiKhuyenMai::find($id) == null)
            return abort(404);

        $this->data['loaikm'] = LoaiKhuyenMai::find($id);
        $this->data['title2'] = 'Loại khuyến mãi: '.LoaiKhuyenMai::find($id)->tensanpham;
        return view('admin.loai-khuyen-mai.edit', $this->data);
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
        if (LoaiKhuyenMai::find($id) == null)
            return abort(404);
        
        $this->validate($request, [
            'tenkhuyenmai' => [
                'required',
                'between:3,191',
                Rule::unique('loaikhuyenmai', 'tenkhuyenmai')->ignore($id),
            ],
            'mota' => 'max:10000',
        ]);

        $loaikm = LoaiKhuyenMai::find($id);
        $loaikm->tenkhuyenmai = $request->tenkhuyenmai;
        $loaikm->mota = $request->mota;
        $loaikm->save();

        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tenkhuyenmai)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (LoaiKhuyenMai::find($id) == null)
            return abort(404);
        $loaikm = LoaiKhuyenMai::find($id);
        $ten = $loaikm->tenkhuyenmai;
        if (count($loaikm->ChiTietKhuyenMai) != 0)
            return back()->with('fail', $ten.' có tồn tại dữ liệu sản phẩm nên tạm thời không thể xóa');
        $loaikm->delete();
        return back()->with('success', 'Đã xóa '.$ten.' thành công');
    }
}

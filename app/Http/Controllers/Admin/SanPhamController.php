<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\SanPham;
use App\Models\LoaiSP;
use App\Models\NhaCungCap;
class SanPhamController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = "Quản lý sản phẩm";
        $this->data['title2'] = 'Sản phẩm';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['dssp'] = SanPham::orderBy('id', 'desc')->paginate(15);
        $this->data['title2'] = 'Danh sách sản phẩm';
        return view('admin.sanpham.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['loaisp'] = LoaiSP::all();
        $this->data['ncc'] = NhaCungCap::all();
        $this->data['title2'] = 'Thêm sản phẩm';
        return view('admin.sanpham.create', $this->data);
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
            'tensanpham' => 'required|between:3,191|unique:sanpham,tensanpham',
            'gia' => 'required|integer|min:0',
            'soluong' => 'required|numeric|min:0',
            'loaisp' => 'required|exists:loaisp,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'mota' => 'max:10000',
        ]);

        SanPham::create([
            'tensanpham' => $request->tensanpham,
            'gia' => $request->gia,
            'soluong' => $request->soluong,
            'loaisp_id' => $request->loaisp,
            'nhacungcap_id' => $request->ncc,
            'mota' => $request->mota,
            'hinhanh' => 'abc.jpg'
        ]);

        return back()->with('success', 'Bạn đã thêm thành công sản phẩm '.$request->tensanpham)->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('chitietsanpham', ['tensp' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (SanPham::find($id) == null)
            return abort(404);

        $this->data['loaisp'] = LoaiSP::all();
        $this->data['ncc'] = NhaCungCap::all();
        $this->data['sp'] = SanPham::find($id);
        $this->data['title2'] = 'Sản phẩm: '.SanPham::find($id)->tensanpham;
        return view('admin.sanpham.edit', $this->data);
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
        if (SanPham::find($id) == null)
            return abort(404);

        $this->validate($request, [
            'tensanpham' => [
                'required',
                'between:3,191',
                Rule::unique('sanpham', 'tensanpham')->ignore($id),
            ],
            'gia' => 'required|integer|min:0',
            'soluong' => 'required|numeric|min:0',
            'loaisp' => 'required|exists:loaisp,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'mota' => 'max:10000',
        ]);

        $sanpham = SanPham::find($id);
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->gia = $request->gia;
        $sanpham->soluong = $request->soluong;
        $sanpham->loaisp_id = $request->loaisp;
        $sanpham->nhacungcap_id = $request->ncc;
        $sanpham->mota = $request->mota;
        $sanpham->save();

        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tensanpham)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (SanPham::find($id) == null)
            return abort(404);
        $sp = SanPham::find($id);
        $ten = $sp->tensanpham;
        if (count($sp->ChiTietHoaDon) != 0)
            return back()->with('fail', 'Sản phẩm '.$ten.' có dữ liệu tồn tại nên tạm thời không thể xóa');
        $sp->delete();
        return back()->with('success', 'Đã xóa '.$ten.' thành công');
    }

    /**
     * Other
     */
    function showImage($id){
        if (SanPham::find($id) == null)
            return abort(404);
        $this->data['sp'] = SanPham::find($id);
        $this->data['title2'] = 'Sản phẩm: '.SanPham::find($id)->tensanpham;
        return view('admin.sanpham.create_image', $this->data);
    }

    function createImage(Request $request, $id){
        if (SanPham::find($id) == null)
            return abort(404);
        $this->validate($request, [
            'img1' => 'image|dimensions:min_width=195,min_height=243',
            'img2' => 'image|dimensions:min_width=100,min_height=120',
        ]);

        $sp = SanPham::find($id);
        $filename = $sp->hinhanh != "abc.jpg" ? $sp->hinhanh : changeTitle($sp->tensanpham)."_$id.png";

        if ($request->checkbox_img1)
            if ($request->file('img1')->isValid()){
                if ($sp->hinhanh != "abc.jpg")
                {
                    $image_path = "/shop/images/pic/$sp->hinhanh";  // Value is not URL but directory file path
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $sp->hinhanh = $filename;
                    $request->file('img1')->move('public/shop/images/pic', $filename);
                }
            }
        
        if ($request->checkbox_img2)
            if ($request->file('img2')->isValid()){
                if ($sp->hinhanh != "abc.jpg")
                {
                    $image_path = "/shop/images/pic/mh_$sp->hinhanh";  // Value is not URL but directory file path
                    if(File::exists($image_path)) {
                        File::delete($image_path);
                    }
                    $sp->hinhanh = $filename;
                    $request->file('img2')->move('public/shop/images/pic', 'mh_'.$filename);
                }
            }
    
        $sp->save();
        return back()->with('success', 'Đã thêm hình ảnh thành công');

        return back()->with('fail', 'Thêm thất bại, vui lòng thử lại');
    }
}

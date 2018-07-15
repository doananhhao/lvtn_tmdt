<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\LoaiKhuyenMai;
use App\Models\ChiTietKhuyenMai;
use App\Models\SanPham;
use App\Models\DangBan;
use Illuminate\Support\Facades\File;
class CTKMController extends Controller
{
    private $data = [];
    private $ds_id_dangban = [];

    function __construct(){
        $this->get_id_sp_dangban();
        $this->data['title'] = "Quản lý ";
        $this->data['title2'] = 'Loại khuyến mãi';
    }

    //sản phẩm đăng bán thì KHÔNG hiển thị trang chủ (sp có khóa ngoại trong dangban là sp dangban)
    private function get_id_sp_dangban(){
        $list = DangBan::select('sanpham_id','id')->groupBy('id')->get();
        $arr_id = [];
        foreach ($list as $sp){
            $arr_id[] = $sp->sanpham_id;
        }
        $this->ds_id_dangban = $arr_id;
        return $arr_id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($loaikm_id)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        if ($loaikm == null)
            return abort(404);
        $this->data['title'] .= $loaikm->tenkhuyenmai;
        $this->data['title2'] = "Chi tiết loại khuyến mãi";
        $this->data['loaikm'] = $loaikm;
        $this->data['ctkm'] = $loaikm->ChiTietKhuyenMai()->orderBy('id', 'desc')->paginate(15);
        return view('admin.chi-tiet-khuyen-mai.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($loaikm_id)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        if ($loaikm == null)
            return abort(404);
        $this->data['title'] .= $loaikm->tenkhuyenmai;
        $this->data['title2'] = "Thêm sản phẩm khuyến mãi";
        $this->data['loaikm'] = $loaikm;
        $this->data['dssp'] = SanPham::whereNotIn('id', $this->getSanPhamThuocLoaiKM($loaikm_id))->whereNotIn('id', $this->ds_id_dangban)->get();
        return view('admin.chi-tiet-khuyen-mai.create', $this->data);
    }

    /**
     * @return array('id', 'id2'...)
     */
    private function getSanPhamThuocLoaiKM($loaikm_id){
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        $dsctkm = $loaikm->ChiTietKhuyenMai;
        $return = [];
        foreach($dsctkm as $ctkm)
            $return[] = $ctkm->sanpham_id;
        return $return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $loaikm_id)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        if ($loaikm == null)
            return abort(404);
        $ds_id = $this->ds_id_dangban;
        $this->validate($request, [
            'sanpham_id' => [
                'required',
                Rule::exists('sanpham', 'id')->where(function ($query) use ($ds_id) {
                    return $query->whereNotIn('id', $ds_id);
                }),
                Rule::unique('chitietkhuyenmai', 'sanpham_id')->where(function ($query) use ($loaikm_id){
                    return $query->where('loaikhuyenmai_id', $loaikm_id);
                }),
            ],
            'giamgia' => 'required|numeric|min:5|max:90',
            'thoigian' => 'required',
            'img' => 'required|image|dimensions:min_width=270,min_height=334',
        ]);

        //Kiểm tra ngày bd và kết thúc
        $thoigian = $request->thoigian;
        if (strpos($thoigian, ' - ') !== false)
            $arr = explode(' - ', $thoigian);
        else{
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }
        try{
            $ngaybd = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $arr[0])));
            $ngayketthuc = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $arr[1])));
        }catch(Exception $e){
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }
        if ($ngaybd >= $ngayketthuc)
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        //Kiểm tra ngày bd và kết thúc

        $this->save_image($request);

        $loaikm->ChiTietKhuyenMai()->create([
            'sanpham_id' => $request->sanpham_id,
            'giamgia' => $request->giamgia/100,
            'ngaybd' => $ngaybd,
            'ngayketthuc' => $ngayketthuc
        ]);

        return back()->with('success', 'Bạn đã thêm thành công')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $loaikm_id, $ctkm
     * @return \Illuminate\Http\Response
     */
    public function show($loaikm_id, $ctkm)
    {
        dd([
            '$loaikm_id' => $loaikm_id,
            '$ctkm' => $ctkm
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $loaikm_id, $ctkm
     * @return \Illuminate\Http\Response
     */
    public function edit($loaikm_id, $ctkm)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        $ctkm = ChiTietKhuyenMai::find($ctkm);

        if ($loaikm == null || $ctkm == null)
            return abort(404);
        
        if ($ctkm->LoaiKhuyenMai->id != $loaikm->id)
            return abort(404);
        $this->data['title'] .= $loaikm->tenkhuyenmai;
        $this->data['title2'] = "Cập nhật thông tin sản phẩm khuyến mãi";
        $this->data['loaikm'] = $loaikm;
        $this->data['ctkm'] = $ctkm;
        //các sản phẫm thuộc $loaikm_id
        $dssp = $this->getSanPhamThuocLoaiKM($loaikm_id);
        //các sản phẩm thuộc $loaikm_id trừ $ctkm
        $dssp = array_diff($dssp, [$ctkm->sanpham_id]);
        $this->data['dssp'] = SanPham::whereNotIn('id', $dssp)->whereNotIn('id', $this->ds_id_dangban)->get();
        return view('admin.chi-tiet-khuyen-mai.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $loaikm_id, $ctkm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loaikm_id, $ctkm)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        $ctkm = ChiTietKhuyenMai::find($ctkm);

        if ($loaikm == null || $ctkm == null)
            return abort(404);
        
        if ($ctkm->LoaiKhuyenMai->id != $loaikm->id)
            return abort(404);

        $ds_id = $this->ds_id_dangban;
        $this->validate($request, [
            'sanpham_id' => [
                'required',
                Rule::exists('sanpham', 'id')->where(function ($query) use ($ds_id) {
                    return $query->whereNotIn('id', $ds_id);
                }),
                Rule::unique('chitietkhuyenmai', 'sanpham_id')->where(function ($query) use ($loaikm_id){
                    return $query->where('loaikhuyenmai_id', $loaikm_id);
                })->ignore($ctkm->id),
            ],
            'giamgia' => 'required|numeric|min:5|max:90',
            'thoigian' => 'required',
            'img' => 'required|image|dimensions:min_width=270,min_height=334',
        ]);

        //Kiểm tra ngày bd và kết thúc
        $thoigian = $request->thoigian;
        if (strpos($thoigian, ' - ') !== false)
            $arr = explode(' - ', $thoigian);
        else{
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }
        try{
            $ngaybd = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $arr[0])));
            $ngayketthuc = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $arr[1])));
        }catch(Exception $e){
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }
        if ($ngaybd >= $ngayketthuc)
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        //Kiểm tra ngày bd và kết thúc

        $this->save_image($request);

        $ctkm->sanpham_id = $request->sanpham_id;
        $ctkm->giamgia = $request->giamgia/100;
        $ctkm->ngaybd = $ngaybd;
        $ctkm->ngayketthuc = $ngayketthuc;
        $ctkm->save();

        return back()->with('success', 'Bạn đã cập nhật thành công')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $loaikm_id, $ctkm
     * @return \Illuminate\Http\Response
     */
    public function destroy($loaikm_id, $ctkm)
    {
        $loaikm = LoaiKhuyenMai::find($loaikm_id);
        $ctkm = ChiTietKhuyenMai::find($ctkm);

        if ($loaikm == null || $ctkm == null)
            return abort(404);
        
        if ($ctkm->LoaiKhuyenMai->id != $loaikm->id)
            return abort(404);

        $ctkm->delete();

        return back()->with('success', 'Bạn đã xóa sản phẩm '.$ctkm->SanPham->tensanpham.' thành công');
    }

    private function save_image($request){
        $sp = SanPham::find($request->sanpham_id);
        if ($request->file('img')->isValid()){
            $image_path = "/shop/images/pic/hd/hd_$sp->hinhanh";  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            $filename = "hd_$sp->hinhanh";
            $request->file('img')->move('public/shop/images/pic/hd', $filename);
        }
    }
}

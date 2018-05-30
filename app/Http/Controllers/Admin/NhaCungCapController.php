<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\NhaCungCap;

class NhaCungCapController extends Controller
{
    private $data = [];
    private $rule_check = [
        'ten' => 'required|between:3,191|unique:nhacungcap,ten',
        'diachi' => 'required|between:3,500',
        'sdt' => 'required|numeric|digits_between:7,14|unique:nhacungcap,sdt',
    ];

    function __construct(){
        $this->data['title'] = "Quản lý nhà cung cấp";
        $this->data['title2'] = 'Nhà cung cấp';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['ncc'] = NhaCungCap::orderBy('id', 'desc')->paginate(15);
        $this->data['title2'] = 'Danh sách nhà cung cấp';
        return view('admin.nha-cung-cap.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title2'] = 'Thêm nhà cung cấp';
        return view('admin.nha-cung-cap.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rule_check);

        NhaCungCap::create([
            'ten' => $request->ten,
            'diachi' => $request->diachi,
            'sdt' => $request->sdt,
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
        return redirect()->route('nha-cung-cap.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (NhaCungCap::find($id) == null)
            return abort(404);
        $this->data['ncc'] = NhaCungCap::find($id);
        $this->data['title2'] = 'Nhà cung cấp: '.NhaCungCap::find($id)->ten;
        return view('admin.nha-cung-cap.edit', $this->data);
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
        if (NhaCungCap::find($id) == null)
            return abort(404);
        $this->validate($request, [
            'ten' => [
                'required',
                'between:3,191',
                Rule::unique('nhacungcap', 'ten')->ignore($id),
            ],
            'diachi' => 'required|between:3,500',
            'sdt' => [
                'required',
                'numeric',
                'digits_between:7,14',
                Rule::unique('nhacungcap', 'sdt')->ignore($id),
            ],
        ]);
        $ncc = NhaCungCap::find($id);
        $ncc->ten = $request->ten;
        $ncc->diachi = $request->diachi;
        $ncc->sdt = $request->sdt;
        $ncc->save();

        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->ten)->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (NhaCungCap::find($id) == null)
            return abort(404);
        $ncc = NhaCungCap::find($id);
        if (count($ncc->SanPham) != 0)
            return back()->with('fail', 'Có sản phẩm đã được lưu bởi nhà cung cấp này nên tạm thời không thể xóa');
        $ten = $ncc->ten;
        $ncc->delete();
        return back()->with('success', 'Đã xóa '.$ten.' thành công');
    }
}

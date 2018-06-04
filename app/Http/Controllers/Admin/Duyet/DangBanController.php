<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DangBan;

class DangBanController extends Controller
{
    private $data = [];

    function __construct(){
        $this->data['title'] = 'Duyệt sản phẩm đăng bán của người dùng';
        $this->data['title2'] = 'Danh sách các yêu cầu';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * null: hiển thị tất cả
         * 0:    hiển thị chưa duyệt
         * 1:    hiển thị đã duyệt
         */
        $tinhtrang = null;
        if ($request->has('tinhtrang'))
            $tinhtrang = $request->get('tinhtrang');

        if ($tinhtrang == null)
            $dangban = DangBan::orderBy('id', 'desc')->paginate(15);
        else $dangban = DangBan::where('tinhtrang', $tinhtrang)->orderBy('id', 'desc')->paginate(15);
        $dangban->appends(request()->query());
        $this->data['dangban'] = $dangban;

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

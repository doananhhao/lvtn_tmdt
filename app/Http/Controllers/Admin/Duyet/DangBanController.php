<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DangBan;
use App\Models\DuyetDangBanHistory;
use App\Models\SanPham;
use App\Models\LoaiSP;
use DB;

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
        $dangban_status = null;
        $loaisp_id = null;
        if ($request->has('dangban'))
            $dangban_status = $request->get('dangban');
        if ($request->has('loaisp'))
            $loaisp_id = $request->get('loaisp');
        // if (($sanpham_id != null && DangBan::where('sanpham_id', $sanpham_id)->first() == null) || ($tinhtrang != null && DangBan::where('tinhtrang', $tinhtrang)->first() == null))
        if ($loaisp_id != null && LoaiSP::find($loaisp_id) == null)
            return abort(404);

        if ($dangban_status == null){
            if ($loaisp_id == null)
                $dangban = DangBan::orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dangban = DangBan::whereIn('sanpham_id', $this->getDS_id_sp_loaisp($loaisp_id))->orderBy('created_at', 'desc')->paginate($this->paginate_set);
        }else if(strtolower($dangban_status) == "moi"){
            if ($loaisp_id == null)
                $dangban = DangBan::where('canduyet', 1)->orderBy('created_at', 'desc')->paginate($this->paginate_set);
            else $dangban = DangBan::where('canduyet', 1)
                                    ->whereIn('sanpham_id', $this->getDS_id_sp_loaisp($loaisp_id))
                                    ->orderBy('created_at', 'desc')->paginate($this->paginate_set);
            // dd($this->getDS_id_sp_loaisp($loaisp_id));
        }else if (strtolower($dangban_status) == "daduyet"){
            //daduyet = DuyetDangBanHistory (status, true: được phép hiển thị)
            $dangban_latest_history = DuyetDangBanHistory::select(DB::raw('dangban_id, MAX(id) as id'))->groupBy('dangban_id')->get();
            $ds_id = [];
            foreach ($dangban_latest_history as $v)
                $ds_id[] = $v->id; //id của dangbanhistory
            //để lấy dangban nào dc phép hiển thị
            $dangbandaduyet = DuyetDangBanHistory::where("status", 1)->whereIn('id', $ds_id)->get();
            $ds_id = [];
            if (!$dangbandaduyet->isEmpty()){
                foreach ($dangbandaduyet as $v)
                    $ds_id[] = $v->dangban_id;  //id của dangban
            }
            $dangban = DangBan::whereIn('id', $ds_id)->paginate($this->paginate_set);
        }

        $dangban->appends(request()->query());
        $this->data['dangban'] = $dangban;
        $this->data['loaisp'] = LoaiSP::all();
        return view('admin.dang-ban.index', $this->data);
    }

    private function getDS_id_sp_loaisp($loaisp_id = null){
        if ($loaisp_id == null)
            return [];
        $loaisp = LoaiSP::find($loaisp_id);
        if ($loaisp == null)
            return [];
        $ds_id = [];
        foreach ($loaisp->SanPham as $sp)
            $ds_id[] = $sp->id;
        return $ds_id;
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
    // public function edit($id)
    // {
    //     if (DangBan::find($id) == null)
    //         return abort(404);
    //     $dangban = DangBan::find($id);
    //     $this->data['dangban'] = $dangban;
    //     $this->data['title2'] = 'Chi tiết thông tin mô tả';
    //     return view('admin.dang-ban.edit', $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     if (DangBan::find($id) == null)
    //         return abort(404);
        
    //     $this->validate($request, [
    //         'mota' => 'required|max:10000',
    //     ]);

    //     $duyet = $request->duyet == 1 ? 1 : 0;

    //     $dangban = DangBan::find($id);
    //     $dangban->mota = $request->mota;
    //     $dangban->tinhtrang = $duyet;
    //     $dangban->save();
        
    //     return back()->with('success', 'Bạn đã cập nhật thành công')->withInput();
    // }

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
        if (!$request->ajax() || $request->dangban_id == null || $request->action == null)
            return response()->json([
                'success' => false,
                'message' => "Không có dữ liệu gửi đi"
            ]);
        
        $dangban = DangBan::find($request->dangban_id);
        if (!in_array($request->action, ['allow', 'deny']))
            return response()->json([
                'success' => false,
                'message' => "Hành động cần thực hiện không đúng [action]"
            ]);
        
        $action = $request->action == 'allow' ? 1 : 0;
        $comment = $request->comment;
        if ($dangban == null)
            return response()->json([
                'success' => false,
                'message' => "Dữ liệu yêu cầu không hợp lệ [ID]"
            ]);
        
        $latest_history = $dangban->DuyetDangBanHistory->sortByDesc('id')->first();
        if ($latest_history != null)
            if ($latest_history->status == 1 && $latest_history->status == $action)
                return response()->json([
                    'success' => false,
                    'message' => "Đăng bán [".$dangban->id."] này đã được [cho phép] thực hiện từ trước"
                ]);
        
        $dangban->DuyetDangBanHistory()->create([
            'comment' => $comment == null ? "" : $comment,
            'status' => $action
        ]);
        $dangban->canduyet = 0;
        $dangban->save();
        
        $return = [
            'success' => true,
            'message' => "[".$action == 1 ? "Cho phép" : "Từ chối"."] yêu cầu đăng bán thành công"
        ];
        return response()->json($return);
    }
}

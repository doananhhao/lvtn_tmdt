<?php

namespace App\Http\Controllers\Admin\Duyet;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HoaDon;

class HoaDonController extends Controller
{
    private $paginate = 15;
    private $data = [];

    function __construct(){
        $this->data['title'] = "Quản lý Hóa đơn";
        $this->data['title2'] = 'Hóa đơn ';
    }

    function index(Request $request){
        /**
         * $mode = null = ds hóa đơn chưa kiểm tra
         *       =  1   = ds hóa đơn cần phân công công việc ĐÓNG GÓI
         *       =  2   = ds hóa đơn cần phân công công việc giao hàng  
         */
        $mode = null;
        if ($request->has('mode'))
            $mode = $request->get('mode');
        if ($mode != null && $mode != 1 && $mode != 2)
            return abort(404);

        if ($mode == null){
            $this->data['title2'] .= 'mới nhận';
            $dshd = HoaDon::where('ischeck', 0)->orderBy('id', 'desc')->paginate($this->paginate);
        }else if ($mode == 1){
            $this->data['title2'] .= 'chuẩn bị ĐÓNG GÓI';
            $dshd = HoaDon::where([['ischeck', 1], ['ispacked', 0]])->orderBy('id', 'desc')->paginate($this->paginate);
        }else if ($mdoe == 2){
            $this->data['title2'] .= 'chuẩn bị GIAO HÀNG';
            $dshd = HoaDon::where([['ispacked', 1], ['isship', 0]])->orderBy('id', 'desc')->paginate($this->paginate);
        }

        return view('admin.hoa-don.index', $this->data);
    }
}

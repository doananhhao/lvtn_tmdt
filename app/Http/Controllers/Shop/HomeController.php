<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\SanPham;
use App\Models\ChiTietHoaDon;

class HomeController extends Controller
{
    protected $data = [];

    function __construct(){
        //New Product của trang chủ
        //Layouts: content -> product-slider -> product-item
        //
        //$sp_moi = array('sp' => collection, 'loaisp' => [])
        //                  |                     |
        //               Chứa 6 sp mới        Chứa các loại của 6sp đó để làm tab
        $this->data['sp_moi'] = $this->getLoaiSPmoi();

        /**
         * Sản phẩm mua nhiều
         * 
         * $sp_mua_nhieu = array(obj(sanpham),...)
         * 
         * Chứa 8 sản phẩm mua nhiều nhất
         * 
         * getDSmuanhieu($sl = số lượng sp cần lấy, $thoigian = [int] ngày - thời gian cần tính vd 30 ~ trong 30 ngày (0 là toàn thời gian))
         */
        $this->data['sp_mua_nhieu'] = $this->getDSmuanhieu(8, 0);
        //mua nhiều trong tháng
        $this->data['mua_nhieu_trong_thang'] = $this->getDSmuanhieu(6, 30);
    }

    function test(){
        echo "<pre>";
        var_dump($this->getDSmuanhieu(6, 30));
    }

    //New Product
    function getSPmoiTheoLoaiSP(){
        //6 sp mới nhất
        $sp_moi = SanPham::orderBy('id', 'desc')->limit(6)->get();
        return $sp_moi;
    }
    function getLoaiSPmoi(){
        $sp_moi = $this->getSPmoiTheoLoaiSP();
        $LoaiSP = [];
        foreach ($sp_moi as $sp){
            $loai = $sp->LoaiSP;

            $exists = false;
            foreach ($LoaiSP as $loaisp){
                if ($loaisp->id == $loai->id){
                    $exists = true;
                    break;
                }
            }
            if ($exists == false)
                $LoaiSP[] = $loai;
        }
        $array = [
            'sp' => $sp_moi,
            'loaisp' => $LoaiSP
        ];
        return $array;
    }
    //---New Product---//
    
    //---Sản phẩm mua nhiều---//
    function getDSmuanhieu($sl = 8, $thoigian = 0){
        //ngày chưa tồn tại csdl
        $defautDate = '2018-05-20 00:00:00';
        if ($thoigian > 0){
            $from = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s')."- $thoigian days"));
        }else
            $from = $defautDate;
        //$list chứa danh sách các sản phẩm mua số lượng nhiều nhất -> ít nhất (8 sản phẩm)
        //gồm sl, sanpham_id
        $list = ChiTietHoaDon::select(DB::raw('sum(soluong) as soluong, sanpham_id'))
            ->whereBetween('created_at', [$from, date('Y-m-d H:i:s')])
            ->groupBy('sanpham_id')
            ->orderBy('soluong', 'desc')
            ->limit($sl)
            ->get();
        $arr = [];
        foreach ($list as $v){
            $arr[] = SanPham::find($v->sanpham_id);
        }
        return $arr;
    }
    //---Sản phẩm mua nhiều---//

    function index(){
        return view('shop.home', $this->data);
    }
}

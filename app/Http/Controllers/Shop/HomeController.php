<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\SanPham;
use App\Models\DangBan;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\LoaiSP;
use App\Models\ChiTietKhuyenMai;

class HomeController extends Controller
{
    protected $data = [];
    private $ds_id_dangban = [];

    function __construct(){
        $this->get_id_sp_dangban();
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

        /**
         * Sản phẩm gợi ý
         */
        $this->data['goi_y'] = $this->getSPgoiy();

        /**
         * Menu 2 trang chủ
         */
        $this->data['sidemenu'] = $this->getSideMenu();

        /**
         * Các sản phẩm đang giảm giá
         */
        $this->data['giamgia'] = $this->getAllSaleProduct();
        $this->data['giamgiadb'] = $this->getSPKMdacbiet();

        $this->data['title'] = "Unicase - Mua hàng trực tiếp Uy tín và Chất lượng";
        
    }

    function test(){
        dd($this->get_id_sp_dangban());
        echo "<pre>";

        // var_dump(ChiTietKhuyenMai::where([
        //     ['sanpham_id', 5],
        //     ['ngayketthuc', '>=', '2018-05-23 15:55:52']
        // ])->orderBy('giamgia', 'desc')->first());
        $list = $this->getSPKMdacbiet();
        foreach ($list as $sp){
            echo "$sp->id - $sp->tensanpham: =score: $sp->score<br>";            
        }

        // var_dump(Session::has('cart'));
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
    //---Khuyến mãi đặc biệt---//
    private function getSPKMdacbiet(){
        $list = ChiTietKhuyenMai::select(DB::raw('max(giamgia) as giamgia, sanpham_id'))
                ->where([
                    ['ngayketthuc', '>=', date('Y-m-d H:i:s')],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->orWhere([
                    ['ngayketthuc', null],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->groupBy('sanpham_id')
                ->orderBy('giamgia', 'desc')
                ->limit(3)
                ->get();
        $list2 = [];
        foreach ($list as $v){
            $sp = SanPham::find($v->sanpham_id);
            $sp->giamgia = $v->giamgia;
            $dg = $sp->DanhGia;
            if ($dg->isEmpty())
                $score = 5;
            else {
                // 1 vote tối đa 10 sao
                $star = 0;
                $vote_count = 0;
                foreach ($dg as $v){
                    $vote_count++;
                    $star += $v->votes;
                }
                $score = round($star / $vote_count);
            }
            $sp->score = $score/2;
            $list2[] = $sp;
        }
        return $list2;
    }
    //---Khuyến mãi đặc biệt---//

    //---Khuyến mãi---//
    private function getAllSaleProduct(){
        $list = ChiTietKhuyenMai::select(DB::raw('max(giamgia) as giamgia, sanpham_id'))
                ->where([
                    ['ngayketthuc', '>=', date('Y-m-d H:i:s')],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->orWhere([
                    ['ngayketthuc', null],
                    ['ngaybd', '<=', date('Y-m-d H:i:s')]
                ])
                ->groupBy('sanpham_id')
                ->get();
        $list2 = [];
        foreach ($list as $v)
            $list2[] = SanPham::find($v->sanpham_id);
        shuffle($list2);
        return $list2;
    }
    //---Khuyến mãi---//

    //---sidemenu---//
    private function getSideMenu(){
        return LoaiSP::orderBy('id', 'desc')->get();
    }
    //---sidemenu---//

    //New Product
    function getSPmoiTheoLoaiSP(){
        //6 sp mới nhất
        $sp_moi = SanPham::whereNotIn('id', $this->ds_id_dangban)->orderBy('id', 'desc')->limit(6)->get();
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

    //---Sản phẩm gợi ý---//
    //$luotmua số lần mua 1 sp để được tính là quan tâm loại sp này
    private function getSPgoiy($luotmua = 3){
        $list = [];
        if (Auth::check()){ // có đăng nhập
            $list = $this->SPgoiy($luotmua);
        }else{              // không đăng nhập
            $list = $this->SPgoiy_nologin();
        }
        return $list;
    }
    private function SPgoiy_nologin(){
        $n = 12;
        $list = $this->getDSmuanhieu($n, 0);
        shuffle($list);
        for ($i = 1; $i <= $n - 7; $i++)
            array_pop($list);
        
        if (count($list) < 6){
            $notin = [];
            foreach ($list as $v)
                $notin[] = $v->id;
            while (count($list) < 6){
                $sp = SanPham::whereNotIn('id', $notin)->whereNotIn('id', $this->ds_id_dangban)->inRandomOrder()->first();
                $list[] = $sp;
                //edited
                if ($sp != null)
                    $notin[] = $sp->id;
            }
        }

        return $list;
    }
    private function SPgoiy($luotmua = 3){
        $id = Auth::User()->id;
        $dshd = HoaDon::where('user_id', $id)->get();        
        // $dshd = HoaDon::where('user_id', 7)->get();

        //người dùng đăng nhập, nhưng chưa thực hiện hóa đơn nào
        if ($dshd->isEmpty())
        {
            $list = $this->SPgoiy_nologin();
            return $list;
        }

        /**Của 1 người dùng đang login
         * $array = array(
         *      'id san pham' => so lượng ĐÃ mua
         * );
         */
        $array = []; //chứa thông tin số lần mua sp của người dùng

        $sp = [];    //chứa sp array(object,...)
        foreach ($dshd as $hd){
            if (!$hd->ChiTietHoaDon->isEmpty()){
                foreach ($hd->ChiTietHoaDon as $CTHD){
                    if (isset($array[$CTHD->sanpham_id]))
                        $array[$CTHD->sanpham_id] += $CTHD->soluong;
                    else $array[$CTHD->sanpham_id] = $CTHD->soluong;
                }
            }
        }

        //chứa array(loaisp_id => sl mua)
        $array2 = $this->tinhloaisp($array);

        /**
         * Sản phẩm người dùng này chưa mua (sp hot, không phải sản phẩm mới)
         * sắp xếp theo thứ tự soluong từ CAO đến THẤP
         * 
         * [
         *      ['sanpham_id'] => array(soluong, loaisp_id)
         * ]
         */
        $array3 = [];

        $list = ChiTietHoaDon::select(DB::raw('sum(soluong) as soluong, sanpham_id'))
            ->groupBy('sanpham_id')
            ->orderBy('soluong', 'desc')
            ->get();
        $ds_id_sp = []; //danh sách các sản phẩm ng dùng (tất cả mọi ng) đã mua, KO PHẢI SẢN PHẨM MỚI CHƯA AI MUA
        foreach ($list as $v){
            $ds_id_sp[] = $v->sanpham_id;
            if (!isset($array[$v->sanpham_id])){
                $arr = [];
                $arr['soluong'] = $v->soluong;
                $arr['loaisp_id'] = SanPham::find($v->sanpham_id)->LoaiSP->id;
                $array3[$v->sanpham_id] = $arr;
            }
        }

        /**
         * Sản phẩm người dùng này chưa mua (sản phấm mới, chưa được mua trong CTHD bởi bất cứ ai)
         */
        $array4 = [];
        
        $list = SanPham::select('id')->whereNotIn('id', $ds_id_sp)->get()->toArray();

        /**
         * Danh sách sp gợi ý
         */
        $loaisp_muanhieu = []; // $array2 có soluong >= $luotmua
        $loaisp_muanhieu2 = [];

        asort($array2);
        $loaisp_muanhieu = array_reverse($array2, true);
        foreach ($array2 as $k=>$v)
            if ($v < $luotmua){ //luotmua không đủ loại khỏi danh sách loaisp quan tâm
                $loaisp_muanhieu2[$k] = $v;
                unset($array2[$k]);
            }
        asort($loaisp_muanhieu2);
        
        $arr_sp = [];
        $arr_sp_pop = [];
        foreach ($loaisp_muanhieu as $key=>$soluong){
            $sanpham_goiy = [];
            $i = 0;
            //array3: sp ng dùng này chưa mua nhưng vẫn có ng khác đã mua
            foreach ($array3 as $k=>$v){
                if ($v['loaisp_id'] == $key){
                    $a = [
                        'sanpham_id' => $k,
                        'value' => $v
                    ];
                    $sanpham_goiy[] = $a;
                    $i++;
                }
                if ($i > 6)
                    break;
            }
            shuffle($sanpham_goiy);
            while ($i >= 3){
                $arr_sp_pop[] = array_pop($sanpham_goiy);
                $i--;
            }
            foreach ($sanpham_goiy as $v)
                $arr_sp[$v['sanpham_id']] = $v['value'];
        }

        //Doi thanh object sp
        $return = [];
        while (count($arr_sp) > 6)
            array_pop($arr_sp);
        foreach ($arr_sp as $k=>$v)
            $return[] = SanPham::find($k);
        
        while (count($return) < 6){
            shuffle($list);
            if (count($list) == 0)
                break;
            $return[] = SanPham::find(array_pop($list)['id']);
        }
        
        while (count($return) < 6){
            shuffle($arr_sp_pop);
            if (count($arr_sp_pop) == 0)
                break;
            $return[] = SanPham::find(array_pop($arr_sp_pop)['sanpham_id']);
        }

        return $return;
    }
    private function tinhloaisp($array = []){ //chuyển từ array(sanpham_id => soluongmua) thành array(loaisp_id => tongsl mua của loaisp)
        $return = [];
        foreach ($array as $k=>$v){
            $loaisp = SanPham::find($k)->LoaiSP;
            if (isset($return[$loaisp->id]))
                $return[$loaisp->id] += $v;
            else $return[$loaisp->id] = $v;
        }
        return $return;
    }
    //---Sản phẩm gợi ý---//

    function index(){
        return view('shop.home', $this->data);
    }
}

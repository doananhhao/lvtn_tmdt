<?php

namespace App\Models;
use Illuminate\Support\Facades\Session;

use App\Models\SanPham;
use App\Models\ChiTietKhuyenMai;

class Cart extends Eloquent
{
	/**
	 * $items = array(
	 * 				[$id sản phẩm] => số lượng mua ($soluong),
	 * 				[$id sản phẩm] => số lượng mua ($soluong),
	 * 			);
	 */
	public $items = null;
	private $fail = 0;

	public function __construct(){
		if(Session::has('cart')){
			$this->items = Session::get('cart');
		}
		$this->check_Validate();
	}

	function getTotalPrice(){
		$this->check_Validate();
		$total = 0;
		foreach ($this->items as $id=>$soluong){
			$price = $this->getPrice($id);
			$total += $price * $soluong;
		}
		return $total;
	}

	function deleteAll(){
		$this->items = null;
		Session::forget('cart');
	}

	function getAll(){
		return $this->items;
	}

	/**
	 * 
	 * $id: id của sản phẩm cần thực hiện
	 * $item: 
	 * 
	 * =============================
	 * 
	 * Thêm: add($id, $soluong)
	 * Xóa: removeItem($id)
	 * 
	 * Số lượng sản phẩm
	 * 	Giảm: reduceByOne($id)
	 * 	Tăng: plusByOne($id)
	 */
	public function add($id, $soluong){
		$giohang = 0;
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
			}
		}
		$giohang += $soluong;
		$this->items[$id] = $giohang;

		$this->update();
	}
	//xóa 1
	public function reduceByOne($id){
		$this->items[$id]--;
		if($this->items[$id] <= 0){
			unset($this->items[$id]);
		}

		$this->update();		
	}
	//xóa nhiều
	public function removeItem($id){
		unset($this->items[$id]);

		$this->update();		
	}

	function plusByOne($id){
		$this->items[$id]++;

		$this->update();
	}

	/**
	 * Giá sau khi trừ giảm giá (nếu có)
	 */
	private function getPrice($id){
		$sanpham = SanPham::find($id);
		$ctkm = ChiTietKhuyenMai::where([
            ['sanpham_id', $id],
            ['ngayketthuc', '>', date('Y-m-d H:i:s')]
		])->orderBy('giamgia', 'desc')->first();
		$price = $sanpham->gia;
		if ($ctkm != null)
			$price = $price * (1 - $ctkm->giamgia);
		return $price;
	}

	function update(){
		Session::put('cart', $this->items);
	}

	private function check_Validate(){
		//số sản phẩm không khả thi (id trong db bị thay đổi)
		$fail = 0;
		foreach ($this->items as $id=>&$item){
			if (SanPham::find($id) == null){
				unset($item);
				$fail++;
			}
		}
		$this->fail = $fail;
		return $fail;
	}
}

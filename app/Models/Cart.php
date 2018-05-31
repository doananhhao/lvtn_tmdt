<?php

namespace App\Models;
use Illuminate\Support\Facades\Session;

use App\Models\SanPham;
use App\Models\ChiTietKhuyenMai;

class Cart
{
	/**
	 * $items = array(
	 * 				[$id sản phẩm] => số lượng mua ($soluong),
	 * 				[$id sản phẩm] => số lượng mua ($soluong),
	 * 			);
	 */
	public $items = [];
	private $fail = 0;

	public function __construct(){
		if(Session::has('cart')){
			$this->items = Session::get('cart');
		}
		$this->check_Validate();
		$this->update();
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

	function SoLuong($id){
		return $this->items[$id];
	}

	/**
	 * giá * sl * khuyen mãi
	 */
	function price($id){
		return $this->items[$id] * $this->getPrice($id);
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
	public function add($id){
		if(array_key_exists($id, $this->items)){
			return false;
		}

		if (SanPham::find($id) == null)
			return false;
		
		$this->items[$id] = 1;

		$this->update();

		return true;
	}
	//xóa 1
	public function reduceByOne($id){
		if (!array_key_exists($id, $this->items))
			return false;
		$this->items[$id]--;
		if($this->items[$id] <= 0){
			// $this->items[$id] = 0;
			unset($this->items[$id]);
			$this->update();
			return false;
		}

		$this->update();
		
		return true;
	}
	//xóa nhiều
	public function removeItem($id){
		if (!array_key_exists($id, $this->items))
			return false;
		unset($this->items[$id]);

		$this->update();
		return true;
	}

	function plusByOne($id){
		if (!array_key_exists($id, $this->items))
			return false;
		$this->items[$id]++;

		$this->update();

		return true;
		
	}

	/**
	 * Giá sau khi trừ giảm giá (nếu có)
	 */
	private function getPrice($id){
		$sanpham = SanPham::find($id);
		$ctkm = ChiTietKhuyenMai::where([
            ['sanpham_id', $id],
            ['ngayketthuc', '>', date('Y-m-d H:i:s')]
		])->orWhere([
			['sanpham_id', $id],
			['ngayketthuc', null]
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
		foreach ($this->items as $id=>$item){
			if (SanPham::find($id) == null){
				unset($this->items[$id]);
				$fail++;
			}
		}
		foreach ($this->items as $id=>$item){
			if ($item == 0)
				unset($this->items[$id]);
		}
		$this->fail = $fail;
		return $fail;
	}
}

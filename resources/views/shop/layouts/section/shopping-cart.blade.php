<div class="col-md-12 col-sm-12 shopping-cart-table ">
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="cart-romove item">Xóa</th>
					<th class="cart-description item">Hình</th>
					<th class="cart-product-name item">Sản phẩm</th>
					<th class="cart-edit item">Khuyến mãi</th>
					<th class="cart-qty item">Số lượng</th>
					<th class="cart-sub-total item">Giá (VNĐ)</th>
					<th class="cart-total last-item">Tổng cộng</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							<span class="">
								<a href="{{ route('home') }}" class="btn btn-upper btn-primary outer-left-xs">Trang chủ</a>
								<a href="{{ route('cart') }}" class="btn btn-upper btn-primary pull-right outer-right-xs">Cập nhật</a>
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php
					use App\Models\SanPham;
					use App\Models\ChiTietKhuyenMai;
				?>
				@foreach($cart->getAll() as $id=>$soluong)
				<?php
					$sp = SanPham::find($id); 
					$ctkm = ChiTietKhuyenMai::where([
								['sanpham_id', $id],
								['ngayketthuc', '>', date('Y-m-d H:i:s')]
							])->orWhere([
								['sanpham_id', $id],
								['ngayketthuc', null]
							])->orderBy('giamgia', 'desc')->first();
				?>
				<tr>
					<td class="romove-item"><a href="#" title="cancel" class="icon"><i class="fa fa-trash-o"></i></a></td>
					<td class="cart-image" style="max-width: 154px; max-height: 146px;">
						<a class="entry-thumbnail" href="{{ route('chitietsanpham', ['tensp' => $id]) }}">
						    <img src="{{ asset('shop/images/pic/mh_'.$sp->hinhanh) }}" class="img-responsive" alt="">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description' style="margin-bottom: 0;">
							<a href="{{ route('chitietsanpham', ['tensp' => $id]) }}">{{ $sp->tensanpham }}</a>
						</h4>
					</td>
					<td class="cart-product-edit">
						@if ($ctkm == null)
						<p class="label label-danger">Không có</p>
						@else
						<p class="label label-success">{{ $ctkm->giamgia*100 }}%</p>
						@endif
					</td>
					<td class="cart-product-quantity">
						<div class="quant-input">
							<div class="arrows">
								<div class="arrow plus gradient" onclick="cal_cart(this, true, {{ $id }})"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								<div class="arrow minus gradient" onclick="cal_cart(this, false, {{ $id }})"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
							</div>
							<input type="text" value="{{ $soluong }}" disabled>
						</div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">{{ number_format($sp->gia,0,',','.') }}</span></td>
					<td class="cart-product-grand-total"><span class="cart-grand-total-price">{{ number_format($cart->price($id),0,',','.') }}</span></td>
				</tr>
				@endforeach
			</tbody><!-- /tbody -->
		</table><!-- /table -->
	</div>
</div><!-- /.shopping-cart-table -->


<div class="col-md-5 col-md-offset-3 col-sm-12 shopping-cart-table" style="font-size:25px">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<td><span class="label label-success" style="padding: 10px">Tổng tiền (VNĐ)</span></td>
					<td class="text-center"><span id="total-price-cart" class="label label-info" style="padding: 10px">{{ number_format($cart->getTotalPrice(),0,',','.') }}</span></td>
				</thead>
				<tfoot>					
					@if (Auth::check())
					<td></td>
					<td class="text-center">
						<a href="#" class="btn btn-primary">ĐẶT HÀNG</a>
					</td>
					@else
					<td class="text-center" colspan="2" style="font-size:15px;">
						<a href="{{ route('login') }}" style="font-size:17px;">Đăng nhập</a> hoặc 
						<a href="{{ route('register') }}" style="font-size:17px;">đăng ký</a>
					</td>
					@endif
				</tfoot>
			</table>
		</div>
	</div>
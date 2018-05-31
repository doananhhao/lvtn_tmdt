<!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->
<?php
	use App\Models\Cart;
	use App\Models\SanPham;

	$header_cart = new Cart();
?>
<div class="dropdown dropdown-cart">
		<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
			<div class="items-cart-inner">
				<div class="total-price-basket">
					<span class="total-price">
						<span class="value" id="totalPrice2">{{ number_format($header_cart->getTotalPrice(),0,',','.') }}</span>
						<span class="sign">vnđ</span>
					</span>
				</div>
				<div class="basket">
					<i class="glyphicon glyphicon-shopping-cart"></i>
				</div>
				<div class="basket-item-count"><span class="count">{{ count($header_cart->getAll()) }}</span></div>
			
		    </div>
		</a>
		<ul class="dropdown-menu">
			<li>
				<div class="cart-item product-summary" id="th_cart">
					@foreach ($header_cart->getAll() as $id=>$soluong)
					<?php $sp = SanPham::find($id) ?>
					<div class="row">
						<div class="col-xs-4">
							<div class="image" style="max-width: 47px; max-height: 61px;">
								<a href="{{ route('chitietsanpham', ['tensp' => $sp->id]) }}"><img src="{{ asset('shop/images/pic/mh_'.$sp->hinhanh) }}" class="img-responsive" alt="{{ $sp->tensanpham }}"></a>
							</div>
						</div>
						<div class="col-xs-7">
							<h3 class="name"><a href="{{ route('chitietsanpham', ['tensp' => $sp->id]) }}">{{ $sp->tensanpham }}</a></h3>
							<div class="price">{{ $sp->gia }}</div>
							<div>x {{ $soluong }}</div>
						</div>
						<div class="col-xs-1 action">
							<a href="#" onclick="XoaCart(this, {{$id}})"><i class="fa fa-trash"></i></a>
						</div>
					</div>
					<hr>
					@endforeach
				</div><!-- /.cart-item -->
				<div class="clearfix"></div>
			<hr>
		
			<div class="clearfix cart-total">
				<div class="pull-right">
					
						<span class="text">Tổng:</span><span class='price' id="totalPrice">{{ number_format($header_cart->getTotalPrice(),0,',','.') }}</span>
						
				</div>
				<div class="clearfix"></div>
					
				<a href="{{ route('cart') }}" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>	
			</div><!-- /.cart-total-->
					
				
		</li>
		</ul><!-- /.dropdown-menu-->
	</div><!-- /.dropdown-cart -->

<!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
@extends('shop.layouts.index')

@section('main_content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Giỏ hàng</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<?php
					use App\Models\Cart;	
					$cart = new Cart();	
				?>
				@if (count($cart->getAll()) == 0)
				<div class="alert alert-info col-md-4 col-md-offset-4 col-sm-12" style="margin-top: 60px;">
					<strong>Thông báo:</strong> Giỏ hàng của bạn hiện chưa có sản phẩm nào.
				</div>
				@else
				@include('shop.layouts.section.shopping-cart')
				@endif
                {{-- @include('shop.layouts.section.estimate-ship-tax') --}}
			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		@include('shop.layouts.brands-carousel')
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

@section('javascript')
<script>
	function cal_cart(e, plus, id){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		ajax = {
			url: plus==true?"{{ route('cart_plus') }}":"{{ route('cart_minus') }}",
			type: "POST",
			dataType: "json",
			data: {
				"id": id
			},
			success: function(data){
				if (!data.success){
					alert("Xóa sản phẩm khỏi giỏ hàng")
					e.parentNode.parentNode.parentNode.parentNode.remove();
					$('#total-price-cart').html(data.totalPrice)
					return;
				}
				price = e.parentNode.parentNode.parentNode.parentNode.lastChild.previousSibling;
				price.lastChild.innerHTML = data.price;
				$('#total-price-cart, #totalPrice2').html(data.totalPrice)
			},
			error: function (data) {
				console.log('Error:', data);
			}
		}
		$.ajax(ajax);
	}
</script>
@endsection
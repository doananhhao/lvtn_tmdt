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
	@if (count($errors) > 0)
	$('#responsive-modal').modal('show');
	@endif
	function deleteItem(e, spxoa){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		ajax = {
			url: "{{route('remove')}}",
			type: "POST",
			dataType: "json",
			data: {
				"id": spxoa
			},
			success: function(data){
				e.parentNode.parentNode.remove();
				$('#total-price-cart').html(data.totalPrice)
				$('#cart_num_' + spxoa).remove()
				$("#totalPrice, #totalPrice2").html(data.totalPrice)
				$('.count').html(data.count)
			},
			error: function (data) {
				console.log('Error:', data);
			}
		}
		$.ajax(ajax);
	}
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
					$('#cart_num_' + id).remove()
					$("#totalPrice, #totalPrice2").html(data.totalPrice)
					$('.count').html(data.count)
					return;
				}
				price = e.parentNode.parentNode.parentNode.parentNode.lastChild.previousSibling;
				price.lastChild.innerHTML = data.price;
				$('span#count_' + id).html(data.soluong)
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
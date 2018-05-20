<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Mua nhiều trong tháng</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	    {{-- @include('shop.layouts.product.product-item') --}}
		@foreach($mua_nhieu_trong_thang as $sp)
			<div class="item item-carousel">
				<div class="products">
					<?php displayProduct($sp->tensanpham, true, false, false, asset('shop/images/pic/'.$sp->hinhanh)) ; ?>
				</div><!-- /.products -->
			</div><!-- /.item -->
		@endforeach
	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
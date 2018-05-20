<!-- ============================================== SCROLL TABS ============================================== -->
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
	<div class="more-info-tab clearfix ">
	   <h3 class="new-product-title pull-left">Sản Phẩm mới</h3>
		<ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
			<li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
			{{-- <li><a data-transition-type="backSlide" href="#smartphone" data-toggle="tab">smartphone</a></li>
			<li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">laptop</a></li>
			<li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">apple</a></li> --}}

			@foreach($sp_moi['loaisp'] as $v)
			<li><a data-transition-type="backSlide" href="#{{ changeTitle($v->tenloai) }}" data-toggle="tab">{{ $v->tenloai }}</a></li>
			@endforeach

		</ul><!-- /.nav-tabs -->
	</div>

	<div class="tab-content outer-top-xs">
		<div class="tab-pane in active" id="all">			
			<div class="product-slider">
				<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
					{{-- @include('shop.layouts.product.product-item') --}}
					@foreach($sp_moi['sp'] as $sp)
					<div class="item item-carousel">
						<div class="products">
							<?php displayProduct($sp->tensanpham, true, false, false, asset('shop/images/pic/'.$sp->hinhanh)) ; ?>
						</div><!-- /.products -->
					</div><!-- /.item -->
					@endforeach
				</div><!-- /.home-owl-carousel -->
			</div><!-- /.product-slider -->
		</div><!-- /.tab-pane -->

		@foreach ($sp_moi['loaisp'] as $v)
		<div class="tab-pane" id="{{ changeTitle($v->tenloai) }}">
			<div class="product-slider">
				<div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
					@foreach($sp_moi['sp'] as $sp)
					@if($sp->loaisp_id == $v->id)
					{{-- @include('shop.layouts.product.product-item') --}}
					<div class="item item-carousel">
						<div class="products">
							<?php displayProduct($sp->tensanpham, true, false, false, asset('shop/images/pic/'.$sp->hinhanh)) ; ?>
						</div><!-- /.products -->
					</div><!-- /.item -->
					@endif
					@endforeach
				</div><!-- /.home-owl-carousel -->
			</div><!-- /.product-slider -->
		</div><!-- /.tab-pane -->
		@endforeach

	</div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->
<!-- ============================================== SCROLL TABS : END ============================================== -->
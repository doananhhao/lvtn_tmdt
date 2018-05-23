<!-- ============================================== HOT DEALS ============================================== -->
<div class="sidebar-widget hot-deals wow fadeInUp">
	{{-- <h3 class="section-title">hot deals</h3> --}}
	<h3 class="section-title">GIÁ ĐẶC BIỆT</h3>
	<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
		
		@foreach($giamgiadb as $v)
		<div class="item">
			<div class="products">
				<div class="hot-deal-wrapper">
					<div class="image">
						<img src="{{ asset('shop/images/pic/hd/hd_'.$v->hinhanh) }}" alt="{{$v->tensanpham}}">
					</div>
					<div class="sale-offer-tag"><span>{{ $v->giamgia*100 }}%<br>off</span></div>
				</div>
			</div><!-- /.hot-deal-wrapper -->

			<div class="product-info text-left m-t-20">
				<h3 class="name"><a href="#">{{ $v->tensanpham }}</a></h3>
				<div class="rating rateit-small"></div>

				<div class="product-price">	
					<span class="price">
						{{ number_format($v->gia*(1-$v->giamgia), 0,",",".") }} VNĐ
					</span>
						
					<span class="price-before-discount">{{ number_format( $v->gia, 0,",",".") }} VNĐ</span>					
				
				</div><!-- /.product-price -->
				
			</div><!-- /.product-info -->

			<div class="cart clearfix animate-effect">
				<div class="action">
					
					<div class="add-cart-button btn-group">
						<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
							<i class="fa fa-shopping-cart"></i>													
						</button>
						<button class="btn btn-primary" type="button">Add to cart</button>
												
					</div>
					
				</div><!-- /.action -->
			</div><!-- /.cart -->
		</div>		
		@endforeach
	    
    </div><!-- /.sidebar-widget -->
</div>
<!-- ============================================== HOT DEALS: END ============================================== -->
<!-- ============================================== SPECIAL DEALS ============================================== -->

<div class="sidebar-widget outer-bottom-small wow fadeInUp">
		{{-- <h3 class="section-title">Special Deals</h3> --}}
		<h3 class="section-title">Khuyến mãi</h3>	
		<div class="sidebar-widget-body outer-top-xs">
			<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
				<?php
					$i = 0;	
				?>
				@foreach ($giamgia as $v)
				@if ($i % 3 == 0)
				<div class="item">
					<div class="products special-product">
						@for ($j = $i; $j < $i + 3; $j++)
							@if (isset($giamgia[$j]))
							<div class="product">
								<?php displayProductMicro($giamgia[$j]->tensanpham, false,true,false,asset('shop/images/pic/muanhieu_'.$giamgia[$j]->hinhanh));?>
							</div>
							@else
							<?php $i = -1 ?>
							@break
							@endif
						@endfor
					</div>
				</div>
					@if ($i < 0)
					@break
					@endif
				@endif
				<?php $i++; ?>
				@endforeach
	
			</div>
		</div><!-- /.sidebar-widget-body -->
	</div><!-- /.sidebar-widget -->
	<!-- ============================================== SPECIAL DEALS : END ============================================== -->
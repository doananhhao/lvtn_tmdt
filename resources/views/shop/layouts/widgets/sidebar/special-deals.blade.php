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
							<?php
								$sp = $giamgia[$j];
								$km = $sp->ChiTietKhuyenMai()->where([['ngayketthuc', '>=', date('Y-m-d H:i:s')], ['ngaybd', '<=', date('Y-m-d H:i:s')]])->first();
								$dg = $sp->DanhGia;
								if ($dg->isEmpty())
									$score = 5;
								else {
									// 1 vote tối đa 10 sao
									$star = 0;
									$vote_count = 0;
									foreach ($dg as $v){
										$vote_count++;
										$star += $v->votes;
									}
									$score = round($star / $vote_count);
								}
							?>
							<div class="product">
									<?php displayProductMicro($sp->tensanpham, false, true, false, asset('shop/images/pic/mh_'.$sp->hinhanh), $sp->id, $km != null ? (1-$km->giamgia)*$sp->gia : $sp->gia, $score/2) ; ?>
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
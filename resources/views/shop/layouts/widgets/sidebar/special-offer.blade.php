<!-- ============================================== SPECIAL OFFER ============================================== -->

<?php
$miniProducts = array(
	array(
		array(
			'product_name' => 'Simple Product',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>true,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Canon EOS 60D',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Sony Camera X30',
			'is_new' => true,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),

	
	array(
		array(
			'product_name' => 'Simple Product',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Canon EOS 60D',
			'is_new' => false,
			'is_sale' =>true,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Sony Camera X30',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),

	
	array(
		array(
			'product_name' => 'Simple Product',
			'is_new' => true,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Canon EOS 60D',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>true,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Sony Camera X30',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productMicroImage' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),

	);

?>
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
	{{-- <h3 class="section-title">Special Offer</h3> --}}
	<h3 class="section-title">Gợi ý</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">

			@for ($i = 1; $i <= 2; $i++)

				<div class="item">
					<div class="products special-product">
							@for ($j = ($i*3)-3; $j <= ($i*3)-1; $j++)
							<?php
								$sp = $goi_y[$j];
								if ($sp == null)
									break;
								$km = $sp->ChiTietKhuyenMai()->where([
									['ngayketthuc', '>=', date('Y-m-d H:i:s')], 
									['ngaybd', '<=', date('Y-m-d H:i:s')]
								])->first();
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
									<?php displayProductMicro($sp->tensanpham, false, false, false, asset('shop/images/pic/mh_'.$sp->hinhanh), $sp->id, $km != null ? (1-$km->giamgia)*$sp->gia : $sp->gia, $score/2) ; ?>								
							</div>
							@endfor
					</div>
				</div>
			
			@endfor
			
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
<!-- ============================================== BEST SELLER ============================================== -->

<?php
$sellerProducts = array(
	array(
		array(
			'product_name' => 'Asus Zenphone 6',
			'is_new' => true,
			'is_sale' =>false,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
	
		array(
			'product_name' => 'Asus Zenphone 6',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),

	
	array(
		array(
			'product_name' => 'Apple Iphone 5s',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
		array(
			'product_name' => 'Apple Iphone 5s',
			'is_new' => false,
			'is_sale' =>true,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),

		),

	
	array(
		array(
			'product_name' => 'Canon EOS 60D',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>true,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
	
		array(
			'product_name' => 'Canon EOS 60D',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),
	array(
		array(
			'product_name' => 'Sony Ericson Vaga',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>true,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),
	
		array(
			'product_name' => 'Sony Ericson Vaga',
			'is_new' => false,
			'is_sale' =>false,
			'is_hot' =>false,
			'productImageURL' => asset('shop/images/pic/rsz_1image6z4kd-640.png')


			),


		),

	);

?>
<div class="sidebar-widget wow fadeInUp outer-bottom-vs">
	<h3 class="section-title">Sản Phẩm mua nhiều</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">

			<?php $i = 1; ?>
			@foreach($sp_mua_nhieu as $v)
				@if($i%2 == 1)

					<div class="item">
						<div class="products best-product">
							@for ($j = $i - 1; $j <= $i; $j++)
							<div class="product">
								<?php displayProductMicro($sp_mua_nhieu[$j]->tensanpham, false, false, true, asset('shop/images/pic/muanhieu_'.$sp_mua_nhieu[$j]->hinhanh)) ?>
							</div>
							@endfor
						</div>
					</div>

				@endif
				<?php $i++; ?>
			@endforeach
			
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== BEST SELLER : END ============================================== -->
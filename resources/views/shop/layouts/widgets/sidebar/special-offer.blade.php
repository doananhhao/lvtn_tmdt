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
	        <?php foreach ($miniProducts as $products):?>
	        <div class="item">
	        	<div class="products special-product">
		        	<?php foreach ($products as $product):?>
						<div class="product">
							<?php displayProductMicro($product['product_name'],$product['is_new'],$product['is_sale'],$product['is_hot'],$product['productMicroImage']);?>
						</div>
		        	<?php endforeach; ?>
	        	</div>
	        </div>
	    	<?php endforeach; ?>
	    </div>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SPECIAL OFFER : END ============================================== -->
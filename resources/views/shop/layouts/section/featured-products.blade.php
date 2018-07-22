<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Mua nhiều trong tháng</h3>
	<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
	    {{-- @include('shop.layouts.product.product-item') --}}
		@foreach($mua_nhieu_trong_thang as $sp)
		<?php
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
			<div class="item item-carousel">
				<div class="products">
					<?php displayProduct($sp->tensanpham, false, false, false, asset('shop/images/pic/'.$sp->hinhanh), $sp->id, 'homepage-cart', $sp->gia, $km != null ? (1-$km->giamgia)*$sp->gia : 0, $score/2) ; ?>
				</div><!-- /.products -->
			</div><!-- /.item -->
		@endforeach
	</div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
<!-- ============================================== FEATURED PRODUCTS : END ============================================== -->
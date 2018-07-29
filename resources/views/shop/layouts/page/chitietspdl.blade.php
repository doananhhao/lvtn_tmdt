@extends('shop.layouts.index')

@section('main_content')





<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li style="white-space: nowrap;"><a href="{{ route('home') }}">Trang chủ</a></li>
				<li style="white-space: nowrap;"><a href="{{route('sanphamdaily')}}?loaisanpham={{ $tenlsp->id }}">{{$tenlsp->tenloai}}</a></li>
				<li class='active'>{{$sanpham->tensanpham}}</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product outer-bottom-sm '>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					<!-- ==============================================CATEGORY============================================== -->

	<!-- ============================================== CATEGORY : END ============================================== -->					<!-- ============================================== HOT DEALS ============================================== -->
@include('shop.layouts.widgets.sidebar.hot-deals')
<!-- ============================================== HOT DEALS: END ============================================== -->					<!-- ============================================== COLOR============================================== -->
@include('shop.layouts.widgets.sidebar.sidebar-advertisement')
    
<!-- ============================================== COLOR: END ============================================== -->
				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
				<div class="row  wow fadeInUp">
					     <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">
            <div class="single-product-gallery-item" id="slide1" style="padding-left: 5.5em">
                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('shop/images/pic/dangban/'.$sanpham->hinhanh) }}">
                    <img class="img-responsive" alt="" src="{{ asset('shop/images/blank.gif') }}" data-echo="{{ asset('shop/images/pic/dangban/'.$sanpham->hinhanh) }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            

        </div><!-- /.single-product-slider -->


        

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">{{$sanpham->tensanpham}}</h1>
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										</div>
									<div class="col-sm-8">
										<div class="reviews">
											
										</div>
									</div>
								</div><!-- /.row -->		
							</div><!-- /.rating-reviews -->

							<div class="stock-container info-container m-t-10">
								<div class="row">
									<div class="col-sm-3">
										<div class="stock-box">
											<span class="label">Tình trạng :</span>
										</div>	
									</div>
									<div class="col-sm-9">
										<div class="stock-box">
											<span class="value">Còn {{$sanpham->soluong}} sản phẩm</span>
										</div>	
									</div>
								</div><!-- /.row -->	
							</div><!-- /.stock-container -->

							<div class="description-container m-t-20">
								
							</div><!-- /.description-container -->

							<div class="price-container info-container m-t-20">
								<div class="row">
									

									<div class="col-sm-12">
										<div class="price-box">
											
											
											<span class="price">{{number_format($sanpham->gia, 0, ',', '.')}} VNĐ</span>
											
										</div>
									</div>

									

								</div><!-- /.row -->
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">
									
									

										<div class="col-sm-2">
												<span class="label">Liên hệ :</span>
											</div>
											
											
		
											<div class="col-sm-7">
												
												<a class="btn btn-primary" >{{$sdttv->sdt == null ? "Xem dưới mô tả" : $sdttv->sdt}}</a>
											</div>

									
								</div><!-- /.row -->
							</div><!-- /.quantity-container -->

							<div class="product-social-link m-t-20 text-right">
								
							</div>

							

							
						</div><!-- /.product-info -->
					</div><!-- /.col-sm-7 -->
				</div><!-- /.row -->

				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">Thông tin</a></li>
								
								<li><a data-toggle="tab" href="#tags">Bình luận</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text">{!!$sanpham->mota!!}</p>
									</div>	
								</div><!-- /.tab-pane -->

										
										

								<div id="tags" class="tab-pane">
									<div class="product-tag">


						<?php
						if (Auth::check()){ // có đăng nhập
							?>
									<div class="review-form">
												<div class="form-container">
													<form action="{{ route('comment',['id' => $sanpham['id']]) }}" method="POST" role="form" class="cnt-form" >
														@csrf
														<div class="row">
															

															<div class="col-md-12">
																<div class="form-group">
																	<h4 class="title-review-comments">Viết bình luận <span class="astk">*</span></h4>
																	<textarea class="form-control txt txt-review" id="bl" name="bl" rows="3" placeholder=""></textarea>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														<div class="action text-right">
															<button type="submit" class="btn btn-primary btn-upper">Bình luận</button>
														</div><!-- /.action -->

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->
											<?php
									        }else{              // không đăng nhập
									        	?>
									        	<div class="review-form">
												<div class="form-container">
													<form role="form" class="cnt-form">

														<div class="row">
															

															<div class="col-md-12">
																<div class="form-group">
																	<h4 class="title-review-comments">Viết bình luận <span class="astk">*</span></h4><br>
																	<div><a href="{{ route('login') }}">Đăng nhập</a> hoặc <a href="{{ route('register') }}">Đăng kí</a> để đặt câu hỏi cho nhà bán hàng ngay và câu trả lời sẽ được hiển thị tại đây.</div>
																</div><!-- /.form-group -->
															</div>
														</div><!-- /.row -->

														

													</form><!-- /.cnt-form -->
												</div><!-- /.form-container -->
											</div><!-- /.review-form -->
									        	<?php
				            
				        } 
				        ?>
										
										
										<div class="blog-review wow fadeInUp">



	<div class="row">
		<div class="col-md-12">
			<h3 class="title-review-comments">Bình luận về sản phẩm này ({{$sobinhluan}})</h3>
		</div>


		@foreach($binhluan as $bl)	
		<div class="col-md-2 col-sm-2">
			<img src="{{ asset('useravatar/noavatar.png') }}" alt="Responsive image" class="img-rounded img-responsive">
		</div>
		<div class="col-md-10 col-sm-10 blog-comments outer-bottom-xs">
			<div class="blog-comments inner-bottom-xs">
				<h4 style="display: inline-block;">{{$bl->name}}</h4>
				<span class="review-action pull-right">
					{{$bl->updated_at->format('d/m/Y')}}   
					
					<!-- <a href="">&sol;  Reply</a> -->
				</span>
				<p>{{$bl->noidung}}</p>
			</div>


			<!-- <div class="blog-comments-responce outer-top-xs ">
				<div class="row">
					<div class="col-md-2 col-sm-2">
						<img src="../shop/images/blog-post/c2.jpg" alt="Responsive image" class="img-rounded img-responsive">
					</div>
					<div class="col-md-10 col-sm-10 outer-bottom-xs">
						<div class="blog-sub-comments inner-bottom-xs">
							<h4 style="display: inline-block;">mike</h4>
							<span class="review-action pull-right">
								03 Day ago &sol;   
								<a href=""> Repost</a> &sol;
								<a href=""> Reply</a>
							</span>
							<p>Integer sit amet commodo eros, sed dictum ipsum. Integer sit amet commodo eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						</div>
					</div>
					
					
				</div>
			</div> -->


		</div>
		@endforeach
		<div class="clearfix"></div>
		<div style="text-align: center;">{{$binhluan->links()}}</div>
		
	</div>
</div>					

									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<!-- ============================================== UPSELL PRODUCTS ============================================== -->

		
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		


@endsection

@section('javascript')
<script src="{{ asset('') }}shop/js/rateit/rater.min.js"></script>
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$("#rate1").rate();

	//or for example
	var options = {
		max_value: 5,
		step_size: 0.5,
	}
	$("#rate1").rate(options);

	$("#rate1").on("change", function(ev, data){
		{{-- console.log(data.from, data.to); --}}
		$('#score_rate').val(data.to)
	});
</script>

@endsection
@extends('shop.layouts.index')

@section('main_content')





<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li style="white-space: nowrap;"><a href="{{ route('home') }}">Trang chủ</a></li>
				<li style="white-space: nowrap;"><a href="{{route('loaisanpham',$tenlsp->id)}}">{{$tenlsp->tenloai}}</a></li>
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
                <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('shop/images/pic/'.$sanpham->hinhanh) }}">
                    <img class="img-responsive" alt="" src="{{ asset('shop/images/blank.gif') }}" data-echo="{{ asset('shop/images/pic/'.$sanpham->hinhanh) }}" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            {{--  <div class="single-product-gallery-item" id="slide2">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/2.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/2.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide3">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/3.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/3.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide4">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/1.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/1.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide5">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/2.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/2.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide6">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/3.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/3.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide7">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/1.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/1.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide8">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/2.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/2.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->

            <div class="single-product-gallery-item" id="slide9">
                <a data-lightbox="image-1" data-title="Gallery" href="../shop/images/single-product/3.jpg">
                    <img class="img-responsive" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/3.jpg" />
                </a>
            </div><!-- /.single-product-gallery-item -->  --}}

        </div><!-- /.single-product-slider -->


        {{--  <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">
                <div class="item">
                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm1.jpg" />
                    </a>
                </div>

                <div class="item">
                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm2.jpg"/>
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="3" href="#slide3">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm3.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="4" href="#slide4">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm1.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="5" href="#slide5">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm2.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="6" href="#slide6">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm3.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="7" href="#slide7">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm1.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="8" href="#slide8">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm2.jpg" />
                    </a>
                </div>
                <div class="item">

                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="9" href="#slide9">
                        <img class="img-responsive" width="85" alt="" src="../shop/images/blank.gif" data-echo="../shop/images/single-product/sm3.jpg" />
                    </a>
                </div>
            </div><!-- /#owl-single-product-thumbnails -->

            

        </div><!-- /.gallery-thumbs -->  --}}

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        			
					<div class='col-sm-6 col-md-7 product-info-block'>
						<div class="product-info">
							<h1 class="name">{{$sanpham->tensanpham}}</h1>
							
							<div class="rating-reviews m-t-20">
								<div class="row">
									<div class="col-sm-3">
										{{-- <div class="rating rateit-small"></div> --}}
										<div class="rateit" data-rateit-value="{{$score1/2}}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
									</div>
									<div class="col-sm-8">
										<div class="reviews">
											<a href="#" class="lnk">({{$sodanhgia}} Đánh giá)</a>
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
											@if ($giamgia != null)
											<span class="price">{{number_format($sanpham->gia*(1-$giamgia->giamgia), 0, ',', '.')}} VNĐ</span>
											<span class="price-strike">{{number_format($sanpham->gia, 0, ',', '.')}} VNĐ</span>
											@else
											<span class="price">{{number_format($sanpham->gia, 0, ',', '.')}} VNĐ</span>
											@endif
										</div>
									</div>

									

								</div><!-- /.row -->
							</div><!-- /.price-container -->

							<div class="quantity-container info-container">
								<div class="row">
									
									{{-- THÊM CHỨC NĂNG SL VÀO --}}
									{{-- <div class="col-sm-2">
										<span class="label">Số lượng :</span>
									</div>
									
									<div class="col-sm-2">
										<div class="cart-quantity">
											<div class="quant-input">
								                <div class="arrows">
								                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
								                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
								                </div>
								                <input type="text" value="1">
							              </div>
							            </div>
									</div> --}}

									<div class="col-sm-7">
										
										<button class="btn btn-primary" type="button" onclick="add_to_cart(this, {{ $sanpham->id }})">Thêm vào giỏ hàng</button>
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
								<li><a data-toggle="tab" href="#review">Đánh Giá</a></li>
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

								<div id="review" class="tab-pane">
									<div class="product-tab">
																				
										<div class="product-reviews">
											<h4 class="title">Đánh giá sản phẩm</h4>

											<div class="container">
												<div class="review-form">
												<div class="form-container">

@if (Auth::check()) {{-- // có đăng nhập --}}
	@if($damua == false)
	<form role="form" class="cnt-form">
			<div class="row">
			<br>
				<div>Bạn phải mua sản phẩm để được đánh giá sản phẩm này.</div>
				<br>
				<br>
				</div> 
														  
				</form><!-- /.cnt-form -->
	@else
				@if($dadg == null)
					<form action="{{ route('review',['id' => $sanpham['id']]) }}" method="POST" role="form" class="cnt-form">
							@csrf
						<div class="row col-md-12">

						<div class="col-lg-3" >
							<br>

							<div id="rate1"  style="font-size: 45px;"></div>
							<div style="font-size: 14px; margin-left: 1px">Chất lượng sản phẩm</div>
							

						{{-- <div class="star-rating">
							<span class="fa fa-star-o" data-rating="1"></span>
							<span class="fa fa-star-o" data-rating="2"></span>
							<span class="fa fa-star-o" data-rating="3"></span>
							<span class="fa fa-star-o" data-rating="4"></span>
							<span class="fa fa-star-o" data-rating="5"></span>
							<input type="hidden" name="whatever1" class="rating-value" value="2.56">
							<div style="font-size: 14px">Chất lượng sản phẩm</div>


						</div> --}}
						
						</div>
						<div class="col-lg-3">
							<div class="form-group">									
								<textarea class="form-control txt txt-review" id="dg" name="dg" rows="4" placeholder=""></textarea>
							</div><!-- /.form-group -->
						</div>
					</div> 
					<div style="width: 48.5%;text-align: right;">
						<input type="hidden" value="0" name="score" id="score_rate"> 
							<button type="submit" class="btn btn-primary btn-upper">Đánh giá</button>
					</div><!-- /.action -->
					</form><!-- /.cnt-form -->
				@else
				
				<form action="{{ route('update-review',['idsp' => $sanpham['id'],'idtv' => Auth::user()->id ]) }}" method="POST" role="form" class="cnt-form">
						@csrf
					<div class="row col-md-12">
	
							<div class="col-lg-3" >
								<br>
	
								<div  id="rate1" data-rate-value="{{$dadg->votes/2}}"  style="font-size: 45px;"></div>
								<div style="font-size: 14px; margin-left: 1px">Chất lượng sản phẩm</div>

							
							</div>
							<div class="col-lg-3">
								<div class="form-group">									
									<textarea class="form-control txt txt-review" id="dg" name="dg" rows="4" placeholder="">{{$dadg->noidung}}</textarea>
								</div><!-- /.form-group -->
							</div>
						</div> 
						<div style="width: 48.5%;text-align: right;">
							<input type="hidden" value="0" name="score" id="score_rate"> 
								<button  type="submit" class="btn btn-primary btn-upper">Cập nhật</button>
						</div><!-- /.action -->
						</form><!-- /.cnt-form -->
				@endif							
@endif
@else        {{--    // không đăng nhập  --}}

<form role="form" class="cnt-form">
	<div class="row">
	<br>
		<div><a href="{{ route('login') }}">Đăng nhập</a>  để đánh giá sản phẩm này.</div>
		<br>
		<br>
		</div> 
												  
		</form><!-- /.cnt-form -->


@endif
		</div><!-- /.form-container -->
		</div><!-- /.review-form -->

		</div><!-- /.product-reviews -->
  
</div>



											
										

										
										<div class="product-add-review">
											<h4 class="title">Nhận xét về sản phẩm</h4>
											
											<div class="product-reviews">
										

										<div class="reviews">
											 <div class="container">


    			
		<div class="row">
			<div class="col-sm-3">
				<div class="rating-block">
					
					<h2 class="bold padding-bottom-7">{{$score1/2}} <small>/ 5</small></h2>

					@if($score2 == 0)
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
				@elseif($score2 == 1) 
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
				@elseif($score2 == 2) 
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
				@elseif($score2 == 3)
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
				@elseif($score2 == 4) 
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-default btn-grey btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
				@elseif($score2 == 5)
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
					  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					<button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
							<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</button>
					@endif
				</div>
			</div>
				
		</div>
		<br>
		<h4>{{$sodanhgia}} Đánh giá</h4>			
		<br>

	
				
		
				
				
		
		
	</div> <!-- /container -->
	@foreach($danhgiasp as $dg)	
				<div class="col-md-2 col-sm-2">
					<img src="{{ asset('useravatar/noavatar.png') }}" alt="Responsive image" class="img-rounded img-responsive">
				</div>
				<div class="col-md-10 col-sm-10 blog-comments outer-bottom-xs">
					<div class="blog-comments inner-bottom-xs">
						<h4 style="display: inline-block;">{{$dg->name}}</h4>
						<span class="review-action pull-right">
								{{$dg->updated_at->format('d/m/Y')}}   
								
								
							</span>
						<br>
						<div class="rateit" data-rateit-value="{{$dg->votes/2}}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
						<p>{{$dg->noidung}}</p>
					</div>
		
		
					
		
		
				</div>
				@endforeach
				<div class="clearfix"></div>
				<div style="text-align: center;">{{$danhgiasp->links()}}</div>

											</div><!-- /.reviews -->
										</div><!-- /.product-reviews -->

										</div><!-- /.product-add-review -->										
										
							        </div><!-- /.product-tab -->
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
<section class="section featured-product wow fadeInUp">
	<h3 class="section-title">Sản phẩm cùng loại</h3>
	<div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
		@foreach($spcungloai as $spcl)
		@if (($spcl->DangBan()->first() == null) && ($spcl->id != $sanpham->id))	
		<div class="item item-carousel">
			<div class="products">
				@php
				$sp = $spcl;
				$km = $sp->ChiTietKhuyenMai()->where([
					['ngayketthuc', '>=', date('Y-m-d H:i:s')],
					['ngaybd', '<=', date('Y-m-d H:i:s')]
				])->first();
				$dg = $sp->DanhGia;
				if ($dg->isEmpty())
					$score123 = 5;
				else {
					// 1 vote tối đa 10 sao
					$star = 0;
					$vote_count = 0;
					foreach ($dg as $v){
						$vote_count++;
						$star += $v->votes;
					}
					$score123 = round($star / $vote_count);
				}
				@endphp
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="{{route('chitietsanpham',$spcl->id)}}"><img  src="{{ asset('shop/images/blank.gif') }}" data-echo="{{ asset('shop/images/pic/'.$spcl->hinhanh) }}" alt=""></a>
			</div><!-- /.image -->			

			                      		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="{{route('chitietsanpham',$spcl->id)}}">{{$spcl->tensanpham}}</a></h3>
			<div class="rateit" data-rateit-value="{{ $score123/2 }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					{{number_format($spcl->gia, 0, ',', ' ')}} VNĐ</span>
										     <span class="price-before-discount"> </span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button"  onclick="add_to_cart(this, {{ $spcl->id }})">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary" type="button" onclick="add_to_cart(this, {{ $spcl->id }})">Add to cart</button>
													
						</li>
	                   
		                
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
		@endif
	@endforeach
		
<!-- ============================================== UPSELL PRODUCTS : END ============================================== -->
			
			</div><!-- /.col -->
			<div class="clearfix"></div>
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection

@section('javascript')
<!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
	
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

	@if (session('success'))
		swal("Cám ơn", "{{ session('success') }}", "success")
	@elseif (session('fail'))
		swal("ERROR", "{{ session('fail') }}")
	@endif
</script>
@endsection
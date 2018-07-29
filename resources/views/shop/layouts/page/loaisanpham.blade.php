@extends('shop.layouts.index')
{{--  <head><title>{{$tenlsp->tenloai}}</title></head>  --}}
@section('main_content')




<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li style="width: 20%"><a href="{{ route('home') }}">Trang chủ</a></li>
				<li class='active'>{{ $tenlsp != null ? $tenlsp->tenloai : "Tất cả"}}</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row outer-bottom-sm'>
			<div class='col-md-3 sidebar'>
	            <!-- ================================== TOP NAVIGATION ================================== -->
@include('shop.layouts.navigation.sidemenu')
<!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">
	            	
	            	<div class="sidebar-filter">
		            	<!-- ============================================== COMPARE============================================== -->

<!-- ============================================== COMPARE: END ============================================== -->
		            			            	<!-- ============================================== COLOR============================================== -->
	@include('shop.layouts.widgets.sidebar.sidebar-advertisement')
    
<!-- ============================================== COLOR: END ============================================== -->

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="{{ asset('shop/images/banners/cat-banner-1.jpg') }}" alt="" class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">
					<div class="big-text">
						Sale
					</div>

					<div class="excerpt hidden-sm hidden-md">
						up to 50% off
					</div>
					
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

		

			
<!-- ========================================= SECTION – HERO : END ========================================= -->
				<div class="clearfix filters-container m-t-10">
	<div class="row">
		<div class="col col-sm-6 col-md-2">
			<div class="filter-tabs">
				<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
					<li class="active">
						<a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-list"></i>Grid</a>
					</li>
					<li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th"></i>List</a></li>
				</ul>
			</div><!-- /.filter-tabs -->
		</div><!-- /.col -->
		<div class="col col-sm-12 col-md-6">
			<div class="col col-sm-3 col-md-6 no-padding">
				
			</div><!-- /.col -->
			<div class="col col-sm-3 col-md-6 no-padding">
				
			</div><!-- /.col -->
		</div><!-- /.col -->
		<div class="col col-sm-6 col-md-4 text-right">
			<div class="pagination-container">
	
</div><!-- /.pagination-container -->		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
				

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs">
								<div class="row">									
			@foreach($loaisp as $sp)
			@if ($sp->DangBan()->first() == null)
			@php
				$sp1 = $sp;
				$km = $sp1->ChiTietKhuyenMai()->where([
					['ngayketthuc', '>=', date('Y-m-d H:i:s')],
					['ngaybd', '<=', date('Y-m-d H:i:s')]
				])->first();
				$dg = $sp1->DanhGia;
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
		<div class="col-sm-6 col-md-4 wow fadeInUp">
			<div class="products">
				
			
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="{{route('chitietsanpham',$sp->id)}}"><img src="{{asset('shop/images/pic/'.$sp->hinhanh)}}"  alt=""></a>
			</div><!-- /.image -->			

			{{-- <div class="tag new"><span>new</span></div> --}}
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="{{route('chitietsanpham',$sp->id)}}">{{$sp->tensanpham}}</a></h3>
			<div class="rateit" data-rateit-value="{{ $score123/2 }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					{{number_format($sp->gia, 0, ',', ' ')}} VNĐ				</span>
										     <span class="price-before-discount"> </span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button"  onclick="add_to_cart(this, {{ $sp->id }})">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary" type="button" onclick="add_to_cart(this, {{ $sp->id }})">Add to cart</button>
													
						</li>
	                   
		                
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		@endif
				@endforeach
										</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
							
						<div class="tab-pane "  id="list-container">
							<div class="category-product  inner-top-vs">
							
			@foreach($loaisp as $list)
			@if ($list->DangBan()->first() == null)		
			@php
				$sp = $list;
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
		<div class="category-product-inner wow fadeInUp">
			
			<div class="products">
								
	            <div class="product-list product">
	<div class="row product-list-row">
		<div class="col col-sm-4 col-lg-4">
			<div class="product-image">
				<div class="image">
					<img  src="{{asset('shop/images/pic/'.$list->hinhanh)}}" alt="">
				</div>
			</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-sm-8 col-lg-8">
			<div class="product-info">
				<h3 class="name"><a href="{{route('chitietsanpham',$list->id)}}">{{$list->tensanpham}}</a></h3>
				<div class="rateit" data-rateit-value="{{ $score123/2 }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>				<div class="product-price">	
					<span class="price">
						{{number_format($list->gia, 0, ',', ' ')}} VNĐ						</span>
												     <span class="price-before-discount">$ 800</span>
											
				</div><!-- /.product-price -->
				<div class="description m-t-10">{{--  {{$list->mota}}  --}}</div>
                				<div class="cart clearfix animate-effect">
					<div class="action">
						<ul class="list-unstyled">
							<li class="add-cart-button btn-group">
								<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
									<i class="fa fa-shopping-cart"></i>													
								</button>
								<button class="btn btn-primary" type="button">Add to cart</button>
														
							</li>
		                   
			                
						</ul>
					</div><!-- /.action -->
				</div><!-- /.cart -->
								
			</div><!-- /.product-info -->	
		</div><!-- /.col -->
	</div><!-- /.product-list-row -->
	{{--  <div class="tag new"><span>new</span></div>    --}}      </div><!-- /.product-list -->
			</div><!-- /.products -->
		</div><!-- /.category-product-inner -->
		
	@endif
		@endforeach
		
	
		
		
										
							</div><!-- /.category-product -->
						</div><!-- /.tab-pane #list-container -->
					</div><!-- /.tab-content -->
					<div class="clearfix filters-container">
						
							<div class="text-right">
						         
									<div style="text-align: right;">{{$loaisp->links()}}</div>
</div><!-- /.pagination-container -->						    </div><!-- /.text-right -->
						
					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->

			</div><!-- /.col -->
			
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
		
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->

</div><!-- /.body-content -->

@endsection

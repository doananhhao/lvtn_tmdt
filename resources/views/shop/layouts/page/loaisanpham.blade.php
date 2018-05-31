@extends('shop.layouts.index')
@section('main_content')




<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Smart Phone</li>
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
	            	<h3 class="section-title">shop by</h3>
	            	<div class="sidebar-filter">
		            	<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
	<div class="widget-header m-t-20">
		<h4 class="widget-title">Category</h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
		<div class="accordion">
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle collapsed">
	                   Camera
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	        <div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle collapsed">
	                  Desktops
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	        <div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseThree" data-toggle="collapse" class="accordion-toggle collapsed">
	                   Pants
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseThree" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	        <div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseFour" data-toggle="collapse" class="accordion-toggle collapsed">
	                   Bags
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseFour" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	        <div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseFive" data-toggle="collapse" class="accordion-toggle collapsed">
	                  Hats
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseFive" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	        <div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="#collapseSix" data-toggle="collapse" class="accordion-toggle collapsed">
	                 Accessories
	                </a>
	            </div><!-- /.accordion-heading -->
	            <div class="accordion-body collapse" id="collapseSix" style="height: 0px;">
	                <div class="accordion-inner">
	                    <ul>
	                        <li><a href="#">gaming</a></li>
	                        <li><a href="#">office</a></li>
	                        <li><a href="#">kids</a></li>
	                        <li><a href="#">for women</a></li>
	                    </ul>
	                </div><!-- /.accordion-inner -->
	            </div><!-- /.accordion-body -->
	        </div><!-- /.accordion-group -->

	    </div><!-- /.accordion -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
		            	<!-- ============================================== PRICE SILDER============================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
	<div class="widget-header">
		<h4 class="widget-title">Price Slider</h4>
	</div>
	<div class="sidebar-widget-body m-t-20">
		<div class="price-range-holder">
      	    <span class="min-max">
                 <span class="pull-left">$200.00</span>
                 <span class="pull-right">$800.00</span>
            </span>
            <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">

            <input type="text" class="price-slider" value="" >
   
        </div><!-- /.price-range-holder -->
        <a href="#" class="lnk btn btn-primary">Show Now</a>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== PRICE SILDER : END ============================================== -->
		            	<!-- ============================================== MANUFACTURES============================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
	<div class="widget-header">
		<h4 class="widget-title">Manufactures</h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
		<ul class="list">
            <li><a href="#">Forever 18</a></li>
            <li><a href="#">Nike</a></li>
            <li><a href="#">Dolce & Gabbana</a></li>
            <li><a href="#">Alluare</a></li>
            <li><a href="#">Chanel</a></li>
            <li><a href="#">Other Brand</a></li>
          </ul>
        <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== MANUFACTURES: END ============================================== -->
		            	<!-- ============================================== COLOR============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
	<div class="widget-header">
		<h4 class="widget-title">Colors</h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
		<ul class="list">
            <li><a href="#">Red</a></li>
            <li><a href="#">Blue</a></li>
            <li><a href="#">Yellow</a></li>
            <li><a href="#">Pink</a></li>
            <li><a href="#">Brown</a></li>
            <li><a href="#">Teal</a></li>
          </ul>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== COLOR: END ============================================== -->
		            	<!-- ============================================== COMPARE============================================== -->
<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">Compare products</h3>
	<div class="sidebar-widget-body">
		<div class="compare-report">
			<p>You have no <span>item(s)</span> to compare</p>
		</div><!-- /.compare-report -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================================== COMPARE: END ============================================== -->
		            			            	<!-- ============================================== COLOR============================================== -->
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
        <div class="item bg-color">
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text">
                        Save<span class="big">50%</span>
                    </div>
                        

                    <div class="excerpt">
                        on selected items
                    </div>
                </div><!-- /.caption -->
            </div><!-- /.container-fluid -->
        </div><!-- /.item -->

        <div class="item" style="background-image: url('assets/images/advertisement/1.jpg');">
            
        </div><!-- /.item -->

        <div class="item bg-color">
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text">
                        Save<span class="big">50%</span>
                    </div>
                        

                    <div class="excerpt fadeInDown-2">
                        on selected items
                    </div>
                </div><!-- /.caption -->
            </div><!-- /.container-fluid -->
        </div><!-- /.item -->

    </div><!-- /.owl-carousel -->
</div>
    
<!-- ============================================== COLOR: END ============================================== -->

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive">
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
				<div class="lbl-cnt">
					<span class="lbl">Sort by</span>
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
							<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
								Position <span class="caret"></span>
							</button>

							<ul role="menu" class="dropdown-menu">
								<li role="presentation"><a href="#">position</a></li>
								<li role="presentation"><a href="#">Price:Lowest first</a></li>
								<li role="presentation"><a href="#">Price:HIghest first</a></li>
								<li role="presentation"><a href="#">Product Name:A to Z</a></li>
							</ul>
						</div>
					</div><!-- /.fld -->
				</div><!-- /.lbl-cnt -->
			</div><!-- /.col -->
			<div class="col col-sm-3 col-md-6 no-padding">
				<div class="lbl-cnt">
					<span class="lbl">Show</span>
					<div class="fld inline">
						<div class="dropdown dropdown-small dropdown-med dropdown-white inline">
							<button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
								1 <span class="caret"></span>
							</button>

							<ul role="menu" class="dropdown-menu">
								<li role="presentation"><a href="#">1</a></li>
								<li role="presentation"><a href="#">2</a></li>
								<li role="presentation"><a href="#">3</a></li>
								<li role="presentation"><a href="#">4</a></li>
								<li role="presentation"><a href="#">5</a></li>
								<li role="presentation"><a href="#">6</a></li>
								<li role="presentation"><a href="#">7</a></li>
								<li role="presentation"><a href="#">8</a></li>
								<li role="presentation"><a href="#">9</a></li>
								<li role="presentation"><a href="#">10</a></li>
							</ul>
						</div>
					</div><!-- /.fld -->
				</div><!-- /.lbl-cnt -->
			</div><!-- /.col -->
		</div><!-- /.col -->
		<div class="col col-sm-6 col-md-4 text-right">
			<div class="pagination-container">
	<ul class="list-inline list-unstyled">
		<li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
		<li><a href="#">1</a></li>	
		<li class="active"><a href="#">2</a></li>	
		<li><a href="#">3</a></li>	
		<li><a href="#">4</a></li>	
		<li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
	</ul><!-- /.list-inline -->
</div><!-- /.pagination-container -->		</div><!-- /.col -->
	</div><!-- /.row -->
</div>
				

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs">
								<div class="row">									
			@foreach($loaisp as $sp)								
		<div class="col-sm-6 col-md-4 wow fadeInUp">
			<div class="products">
				
			
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="{{route('chitietsanpham',$sp->id)}}"><img  src="../shop/images/pic/{{$sp->hinhanh}}"  alt=""></a>
			</div><!-- /.image -->			

			<div class="tag new"><span>new</span></div>                        		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="{{route('chitietsanpham',$sp->id)}}">{{$sp->tensanpham}}</a></h3>
			<div class="rating rateit-small"></div>
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
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<button class="btn btn-primary" type="button">Add to cart</button>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="{{route('chitietsanpham',$sp->id)}}" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						<li class="lnk">
							<a class="add-to-cart" href="{{route('chitietsanpham',$sp->id)}}" title="Compare">
							    <i class="fa fa-retweet"></i>
							</a>
						</li>
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div><!-- /.product -->
      
			</div><!-- /.products -->
		</div><!-- /.item -->
	
		
				@endforeach
										</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
							
						<div class="tab-pane "  id="list-container">
							<div class="category-product  inner-top-vs">
							
			@foreach($loaisp as $list)							
		<div class="category-product-inner wow fadeInUp">
			<div class="products">				
	            <div class="product-list product">
	<div class="row product-list-row">
		<div class="col col-sm-4 col-lg-4">
			<div class="product-image">
				<div class="image">
					<img data-echo="../shop/images/products/c1.jpg" src="../shop/images/blank.gif" alt="">
				</div>
			</div><!-- /.product-image -->
		</div><!-- /.col -->
		<div class="col col-sm-8 col-lg-8">
			<div class="product-info">
				<h3 class="name"><a href="{{route('chitietsanpham',$list->id)}}">{{$list->tensanpham}}</a></h3>
				<div class="rating rateit-small"></div>
				<div class="product-price">	
					<span class="price">
						{{number_format($list->gia, 0, ',', ' ')}} VNĐ						</span>
												     <span class="price-before-discount">$ 800</span>
											
				</div><!-- /.product-price -->
				<div class="description m-t-10">{{$list->mota}}</div>
                				<div class="cart clearfix animate-effect">
					<div class="action">
						<ul class="list-unstyled">
							<li class="add-cart-button btn-group">
								<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
									<i class="fa fa-shopping-cart"></i>													
								</button>
								<button class="btn btn-primary" type="button">Add to cart</button>
														
							</li>
		                   
			                <li class="lnk wishlist">
								<a class="add-to-cart" href="{{route('chitietsanpham',$list->id)}}" title="Wishlist">
									 <i class="icon fa fa-heart"></i>
								</a>
							</li>

							<li class="lnk">
								<a class="add-to-cart" href="{{route('chitietsanpham',$list->id)}}" title="Compare">
								    <i class="fa fa-retweet"></i>
								</a>
							</li>
						</ul>
					</div><!-- /.action -->
				</div><!-- /.cart -->
								
			</div><!-- /.product-info -->	
		</div><!-- /.col -->
	</div><!-- /.product-list-row -->
	<div class="tag new"><span>new</span></div>        </div><!-- /.product-list -->
			</div><!-- /.products -->
		</div><!-- /.category-product-inner -->
		
	
		@endforeach
		
	
		
		
										
							</div><!-- /.category-product -->
						</div><!-- /.tab-pane #list-container -->
					</div><!-- /.tab-content -->
					<div class="clearfix filters-container">
						
							<div class="text-right">
						         <div class="pagination-container">
	<ul class="list-inline list-unstyled">
		<li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
		<li><a href="#">1</a></li>	
		<li class="active"><a href="#">2</a></li>	
		<li><a href="#">3</a></li>	
		<li><a href="#">4</a></li>	
		<li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
	</ul><!-- /.list-inline -->
</div><!-- /.pagination-container -->						    </div><!-- /.text-right -->
						
					</div><!-- /.filters-container -->

				</div><!-- /.search-result-container -->

			</div><!-- /.col -->
		</div><!-- /.row -->
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<h3 class="section-title">Our Brands</h3>
		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div><!-- /.container -->

</div><!-- /.body-content -->

@endsection
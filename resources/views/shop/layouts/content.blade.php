<div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
        <div class="row">
        <!-- ============================================== SIDEBAR ============================================== -->	
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                
                @include('shop.layouts.product.product-micro')

                @include('shop.layouts.navigation.sidemenu')

                @include('shop.layouts.widgets.sidebar.special-offer')

                @include('shop.layouts.widgets.sidebar.product-tags')

                @include('shop.layouts.widgets.sidebar.special-deals')

                @include('shop.layouts.widgets.sidebar.newsletter')

                @include('shop.layouts.widgets.sidebar.hot-deals')

                @include('shop.layouts.widgets.sidebar.sidebar-advertisement')
    
            </div><!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->
    
            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                
                @include('shop.layouts.home-page-slider1')

                @include('shop.layouts.section.info-boxes')           

                @include('shop.layouts.product.product-slider')
    
                @include('shop.layouts.section.wide-banners')
    
                @include('shop.layouts.section.featured-products')
    
                @include('shop.layouts.section.wide-banners-2')
    
                @include('shop.layouts.section.best-seller')
    
                @include('shop.layouts.section.blog-slider')
    
                @include('shop.layouts.section.new-arrivals')

            </div><!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div><!-- /.row -->
        @include('shop.layouts.brands-carousel')
    
        </div><!-- /.container -->
    </div><!-- /#top-banner-and-menu -->
    
    
    
    
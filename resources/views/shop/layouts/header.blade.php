<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">

	@include('shop.layouts.navigation.top-bar')

	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
					@include('shop.layouts.widgets.header.logo')
				</div><!-- /.logo-holder -->

				<div class="col-xs-12 col-sm-12 col-md-6 top-search-holder">
					@include('shop.layouts.widgets.header.search-bar')
				</div><!-- /.top-search-holder -->

				<div class="col-xs-12 col-sm-12 col-md-3 animate-dropdown top-cart-row">
					@include('shop.layouts.widgets.header.shopping-cart-dropdown')
				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->

		</div><!-- /.container -->

	</div><!-- /.main-header -->

	@include('shop.layouts.navigation.navbar')

</header>

<!-- ============================================== HEADER : END ============================================== -->
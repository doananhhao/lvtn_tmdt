<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="{{ Route::current()->getName() == 'home' ? 'active ' : '' }}dropdown">
				<a href="{{ route('home') }}">Home</a>
				{{-- <a href="{{ route('home') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a> --}}
				{{-- <ul class="dropdown-menu">
					<li>
                        @include('shop.layouts.navigation.megamenu')
					</li>
				</ul> --}}
			</li>
			<li class="dropdown">
				{{-- <a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Desktop</a>
				<ul class="dropdown-menu">
					<li>
                        @include('shop.layouts.navigation.megamenu-fullwidth')
					</li>
				</ul> --}}
			</li>

			<li class="dropdown">
				<a href="{{route('sanphamdaily')}}">Sản phẩm thành viên bán
					<span class="menu-label new-menu hidden-xs">new</span>
				</a>
			</li>

			<li class="dropdown">
				<a href="{{route('sanphamdaily')}}">Sản phẩm của Đại lý</a>
			</li>

			<li class="dropdown">
				<a href="{{ route('csbh') }}">
					Chính sách bán hàng
				</a>
			</li>

			<li class="dropdown">
				<a href="#">Thông tin</a>
			</li>
			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->
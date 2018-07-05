<div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
	<div class="nav-outer">
		<ul class="nav navbar-nav">
			<li class="active dropdown yamm-fw">
				<a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Home</a>
				<ul class="dropdown-menu">
					<li>
                        @include('shop.layouts.navigation.megamenu')
					</li>
				</ul>
			</li>
			<li class="dropdown yamm">
				<a href="#" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Desktop</a>
				<ul class="dropdown-menu">
					<li>
                        @include('shop.layouts.navigation.megamenu-fullwidth')
					</li>
				</ul>
			</li>

			<li class="dropdown">
				
				<a href="#">Electronics
				   <span class="menu-label hot-menu hidden-xs">hot</span>
				</a>
			</li>
			<li class="dropdown hidden-sm">
				
				<a href="#">Television
				    <span class="menu-label new-menu hidden-xs">new</span>
				</a>
			</li>

			<li class="dropdown hidden-sm">
				<a href="{{route('sanphamdaily')}}">Sản phẩm của Đại lý</a>
			</li>

			<li class="dropdown">
				<a href="#">Contact</a>
			</li>
			
		</ul><!-- /.navbar-nav -->
		<div class="clearfix"></div>				
	</div><!-- /.nav-outer -->
</div><!-- /.navbar-collapse -->
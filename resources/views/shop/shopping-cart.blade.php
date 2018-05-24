@extends('shop.layouts.index')

@section('main_content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
                @include('shop.layouts.section.shopping-cart')
                @include('shop.layouts.section.estimate-ship-tax')
			</div><!-- /.shopping-cart -->
		</div> <!-- /.row -->
		@include('shop.layouts.brands-carousel')
	</div><!-- /.container -->
</div><!-- /.body-content -->

@endsection
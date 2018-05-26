<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Meta -->
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
		<meta name="robots" content="all">
		<meta name="csrf-token" content="{{ csrf_token() }}">
	    <title>Unicase</title>

	    <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="{{ asset('') }}shop/css/bootstrap.min.css">
	    
	    <!-- Customizable CSS -->
	    <link rel="stylesheet" href="{{ asset('') }}shop/css/main.css">
	    <link rel="stylesheet" href="{{ asset('') }}shop/css/green.css">
	    <link rel="stylesheet" href="{{ asset('') }}shop/css/owl.carousel.css">
		<link rel="stylesheet" href="{{ asset('') }}shop/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="{{ asset('') }}shop/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('') }}shop/css/animate.min.css">
		<link rel="stylesheet" href="{{ asset('') }}shop/css/rateit.css">
		<link rel="stylesheet" href="{{ asset('') }}shop/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="{{ asset('') }}shop/css/config.css">

		<link href="{{ asset('') }}shop/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="{{ asset('') }}shop/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="{{ asset('') }}shop/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="{{ asset('') }}shop/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="{{ asset('') }}shop/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="{{ asset('') }}shop/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="{{ asset('') }}shop/images/favicon.ico">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->


		<style type="text/css">
	    	.star-rating {
  line-height:32px;
  font-size:2.5em;
}

.star-rating .fa-star{color: yellow;}






	    </style>

	</head>
    <body class="cnt-home">

		@include('shop.layouts.header')

		@yield('main_content')

		@include('shop.layouts.footer')

	<!-- For demo purposes – can be removed on production -->
	
	<div class="config open">
		<div class="config-options">
			<h4>Colors</h4>
			<ul>
				<li><a class="changecolor green-text" href="#" title="Green color">Green</a></li>
                <li><a class="changecolor blue-text" href="#" title="Blue color">Blue</a></li>
                <li><a class="changecolor red-text" href="#" title="Red color">Red</a></li>
                <li><a class="changecolor orange-text" href="#" title="Orange color">Orange</a></li>
                <li><a class="changecolor dark-green-text" href="#" title="Darkgreen color">Dark Green</a></li>
			</ul>
		</div>
		<a class="show-theme-options" href="#"><i class="fa fa-wrench"></i></a>
	</div>
	<!-- For demo purposes – can be removed on production : End -->

	<!-- JavaScripts placed at the end of the document so the pages load faster -->
	<script src="{{ asset('') }}shop/js/jquery-1.11.1.min.js"></script>
	
	<script src="{{ asset('') }}shop/js/bootstrap.min.js"></script>
	
	<script src="{{ asset('') }}shop/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="{{ asset('') }}shop/js/owl.carousel.min.js"></script>
	
	<script src="{{ asset('') }}shop/js/echo.min.js"></script>
	<script src="{{ asset('') }}shop/js/jquery.easing-1.3.min.js"></script>
	<script src="{{ asset('') }}shop/js/bootstrap-slider.min.js"></script>
    <script src="{{ asset('') }}shop/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}shop/js/lightbox.min.js"></script>
    <script src="{{ asset('') }}shop/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('') }}shop/js/wow.min.js"></script>
	<script src="{{ asset('') }}shop/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="{{ asset('') }}/switchstylesheet/switchstylesheet.js"></script>
	
	@yield('javascript')

	<script>
		// add to cart
		var atc = function(data){
			var product = document.createElement("div");
			product.className = 'row';
			
			document.getElementById('th_cart').appendChild(product);
			var row1 = "";
			row1 += '<div class="col-xs-4">';
			row1 += '<div class="image" style="max-width: 47px; max-height: 61px;">';
			//row1 += '<a href="' + baseurl + '/san-pham/' + urlsanpham + '"><img src="' + baseurl + '/shop/images/sanpham/' + urlsanpham + '.jpg" alt=""></a>';
			row1 += '<a href="' + data.product_URL + '"><img src="' + data.imageURL + '" class="img-responsive" alt="' + data.product_name + '"></a>';
			row1 += '</div></div>';
			
			product.innerHTML += '<br>' + row1;
			
			var row2 = "";
			row2 += '<div class="col-xs-7">';
			//row2 += '<h3 class="name"><a href="' + baseurl + '/san-pham/' + urlsanpham + '">' + tensp + '</a></h3>';
			//row2 += '<div class="price">' + gia + 'đ</div>';
			row2 += '<h3 class="name"><a href="' + data.product_URL + '">' + data.product_name + '</a></h3>';
			row2 += '<div class="price">' + data.price + '</div>';
			row2 += '<div>x 1</div></div>';
			
			product.innerHTML += row2;
			
			product.innerHTML += '<div class="col-xs-1 action"><a href="#" onclick="XoaCart(this, ' + data.id + ')"><i class="fa fa-trash"></i></a></div>';

			document.getElementById('th_cart').innerHTML += "<hr>";
		}
		function XoaCart(e, spxoa){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			ajax = {
				url: "{{route('remove')}}",
				type: "POST",
				dataType: "json",
				data: {
					"id": spxoa
				},
				success: function(data){
					$("#totalPrice, #totalPrice2").html(data.totalPrice)
					$('.count').html(data.count)
					e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode)
				},
				error: function (data) {
					console.log('Error:', data);
				}
			}
			$.ajax(ajax);
		}
		function add_to_cart(e, id){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			ajax = {
				url: "{{route('add-to-cart')}}",
				type: "POST",
				dataType: "json",
				data: {
					"id": id
				},
				success: function(data){
					if (!data.success){
						alert("Sản phẩm đã có rồi")
						return;
					}
					$("#totalPrice, #totalPrice2").html(data.totalPrice)
					$('.count').html(data.count)
					atc(data)
				},
				error: function (data) {
					console.log('Error:', data);
				}
			}
			$.ajax(ajax);
		}
		// add to cart

		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	<script type="text/javascript">
	var $star_rating = $('.star-rating .fa');

var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});

SetRatingStar();
</script>

</body>
</html>
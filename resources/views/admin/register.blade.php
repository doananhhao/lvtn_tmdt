<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('') }}plugins/images/favicon.png">
<title>Đăng Ký - Signup</title>
<!-- Bootstrap Core CSS -->
<link href="{{ asset('admin') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ asset('') }}plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
<!-- animation CSS -->
<link href="{{ asset('admin') }}/css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('admin') }}/css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="{{ asset('admin') }}/css/colors/default.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-19175540-9', 'auto');
  // ga('send', 'pageview');

</script>
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="{{ route('register') }}" method="POST">
        
        @csrf

        <h3 class="box-title m-b-20">Đăng Ký</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}" required placeholder="Email">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" required placeholder="Password">
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="password_confirmation" required placeholder="Confirm Password">
          </div>
        </div>
        {{-- <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
            </div>
          </div>
        </div> --}}
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Đăng Ký</button>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Bạn đã có tài khoản? <a href="{{ route('login') }}" class="text-primary m-l-5"><b>Đăng Nhập</b></a></p>
          </div>
        </div>
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Quay về<a href="{{ route('home') }}" class="text-info m-l-5"><b>Trang chủ</b></a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="{{ asset('') }}plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('admin') }}/bootstrap/dist/js/tether.min.js"></script>
<script src="{{ asset('admin') }}/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('') }}plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('') }}plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="{{ asset('admin') }}/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="{{ asset('admin') }}/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('admin') }}/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="{{ asset('') }}plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>

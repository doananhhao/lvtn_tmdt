<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('') }}plugins/images/favicon.png">
<title>Đăng nhập - Login</title>
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
      <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="POST">
        @csrf
        <h3 class="box-title m-b-20">Đăng Nhập</h3>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="form-group">
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
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="checkbox-signup"> Remember me </label>
            </div>
            {{-- <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right">
              <i class="fa fa-lock m-r-5"></i> Forgot pwd?
            </a> --}}
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Đăng Nhập</button>
          </div>
        </div>
        {{-- <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
            <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
          </div>
        </div> --}}
        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Bạn chưa có tài khoản? <a href="{{ route('register') }}" class="text-primary m-l-5"><b>Đăng Ký</b></a></p>
          </div>
        </div>

        <div class="form-group m-b-0">
          <div class="col-sm-12 text-center">
            <p>Quay về<a href="{{ route('home') }}" class="text-info m-l-5"><b>Trang chủ</b></a></p>
          </div>
        </div>
      </form>
      {{-- <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recover Password</h3>
            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form> --}}
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

<script>
  @if(session('inactive'))
  setTimeout(function (){
    alert("{{ session('inactive') }}")
  }, 500);
  @endif
</script>
</body>
</html>

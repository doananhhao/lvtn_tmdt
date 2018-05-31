<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Inbox</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('') }}shop/info/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('') }}shop/info/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('') }}shop/info/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('') }}shop/info/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('') }}shop/info/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="../shop/images/pic/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Đơn hàng của tôi</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Đơn hàng hủy</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>Quản lý tài khoản</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="button.html">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="badge.html">Đổi mật khẩu</a>
                                </li>
                                <li>
                                    <a href="tab.html">Mã giảm giá</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                    </ul>
                  
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{asset('shop/images/pic/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                @include('shop.layouts.page.nav-info')
                
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap" style="float:  right;">
                            
                            <div class="header-button" >
                                
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="{{asset('shop/images/pic/images/icon/avatar-01.jpg')}}"  />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="{{asset('shop/images/pic/images/icon/avatar-01.jpg')}}" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->

            @yield('content')
            
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('') }}shop/info/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('') }}shop/info/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('') }}shop/info/vendor/slick/slick.min.js">
    </script>
    <script src="{{ asset('') }}shop/info/vendor/wow/wow.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/animsition/animsition.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="{{ asset('') }}shop/info/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="{{ asset('') }}shop/info/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="{{ asset('') }}shop/info/vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="{{ asset('') }}shop/info/js/main.js"></script>

</body>

</html>
<!-- end document-->
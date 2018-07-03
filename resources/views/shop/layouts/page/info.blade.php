<!DOCTYPE html>  
<html lang="en">

<head>

    
    @include('admin.layouts.head')
        <style type="text/css">
            .progress {
                margin: 10px;
                width: 50%;
                height: 20px;
                border-radius: 7px;
              }

        </style>
</head>

<body>
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <div class="user-profile">
                <div class="dropdown user-pro-body">
                    <div><img src="{{asset('plugins/images/users/varun.jpg')}}" alt="user-img" class="img-circle"></div>
                    <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                    <ul class="dropdown-menu animated flipInY">
                        
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> &nbsp; Đăng xuất
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="nav" id="side-menu">
                <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                    <!-- input-group -->
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
        <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
        </span> </div>
                    <!-- /input-group -->
                </li>
                <li class="nav-small-cap m-t-10">--- Quản lý tài khoản</li>
                <li> <a href="index.html" class="waves-effect"><i class="linea-icon icon-user fa-fw " data-icon="v"></i> <span class="hide-menu "> Thông tin tài khoản<span class="fa arrow"></span> </span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="{{ route('acc-info') }}">Thông tin cá nhân </a> </li>
                        <li> <a href="{{ route('change-password') }}">Đổi mật khẩu</a> </li>
                       
                        <li> <a href="{{ route('level') }}">Thành viên</a> </li>
                    </ul>
                </li>
                
                <li class="nav-small-cap">--- Quản lý hóa đơn</li>
                <li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon icon-basket-loaded fa-fw"></i> <span class="hide-menu">Đơn hàng của tôi<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('order_list') }}">Danh sách đơn hàng</a></li>
                        <li><a href="{{ route('cancel_order_list') }}">Đơn hàng hủy</a></li>
                        
                    </ul>
                </li>
                @if(Auth::user()->ThanhVien != null)
                    @if(Auth::user()->ThanhVien->DaiLy != null)
                <li class="nav-small-cap">--- Đại lý bán hàng</li>
                <li><a href="#" class="waves-effect"><i data-icon=")" class="linea-icon ti-pin2 fa-fw"></i> <span class="hide-menu">Quản lý Đăng bán<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="{{ route('sell_list') }}">Danh sách đăng bán</a></li>
                        <li><a href="{{ route('sell') }}">Đăng bán</a></li>
                    </ul>
                </li>
                @endif
                @endif
                </ul>
                
        </div>
    </div>
    <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Xin chào, {{Auth::user()->name}}</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <a href="{{ route('home') }}"  class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Trang chủ</a>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>

           
            @yield('content')
            
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Elite Admin brought to you by themedesigner.in </footer>
    </div>
   
    @include('admin.layouts.footer')
    @yield('custom_plugin')
</body>

</html>
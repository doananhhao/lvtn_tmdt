<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Danh mục sản phẩm</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">

            @foreach($sidemenu as $v)
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle"><i class="{{ $v->classfaicon }}"></i>{{ $v->tenloai }}</a>
            </li><!-- /.menu-item -->
            @endforeach

            {{-- <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-desktop fa-fw"></i>TV & Đồ điện gia dụng</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-mobile fa-fw"></i>Thiết bị điện tử</a>
                 @include('shop.layouts.navigation.megamenu-vertical')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-apple fa-fw"></i>Sức khỏe và làm đẹp</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-camera fa-fw"></i>Mẹ, Bé & Đồ chơi</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-headphones fa-fw"></i>Phụ kiện điện tử</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-gamepad fa-fw"></i>Thể thao & Du lịch</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-location-arrow fa-fw"></i>Ô tô & Xe máy</a>
                 @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-history fa-fw"></i>Thời trang</a>
                @include('shop.layouts.navigation.megamenu-vertical')
            </li><!-- /.menu-item -->

            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-microphone fa-fw"></i>Phụ kiện Thời trang</a>
                @include('shop.layouts.navigation.megamenu-horizontal')
            </li><!-- /.menu-item --> --}}
          
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->
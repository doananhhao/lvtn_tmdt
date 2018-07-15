<div class="contact-row">
        <div class="phone inline">
            <i class="icon fa fa-phone"></i> (400) 888 888 868
        </div>
        <div class="contact inline">
            <i class="icon fa fa-envelope"></i> admin@gmail.com
        </div>
    </div><!-- /.contact-row -->
    <!-- ============================================================= SEARCH AREA ============================================================= -->
    <div class="search-area">
        <form method="GET" action="{{ route('tim-kiem') }}" id="search-form">
            <div class="control-group">
    
                <ul class="categories-filter animate-dropdown">
                    <li class="dropdown">
    
                        <a class="dropdown-toggle"  data-toggle="dropdown" href="#">Danh mục <b class="caret"></b></a>
    
                        <ul class="dropdown-menu" role="menu" >
                        {{-- <li class="menu-header">Tất cả</li> --}}
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('home') }}">- Tất cả</a></li>
                        @foreach ($sidemenu as $v)
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('loaisanpham', ['type' => $v->id]) }}">- {{ $v->tenloai }}</a></li>
                        @endforeach
                    </ul>
                    </li>
                </ul>
    
                <input class="search-field" name="search_input" type="text" value="{{ request()->has('search_input') ? request()->get('search_input') : ''}}" placeholder="Tìm kiếm..." />
                @if (isset($is_type))
                <input type="hidden" name="loaisp" value="{{ $is_type }}">
                @endif
                <a class="search-button" href="#" ></a>    
    
            </div>
        </form>
    </div><!-- /.search-area -->
    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
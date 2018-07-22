<!DOCTYPE html>  
<html lang="en">

<head>
    @include('admin.layouts.head')
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>

    <div id="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.left-sidebar')

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                @include('admin.layouts.breadcrumbs')

                @yield("content")

                @include('admin.layouts.right-sidebar')
            </div>
        </div>

    </div>
    <!-- /#wrapper -->
    @include('admin.layouts.footer')
    @yield('custom_plugin')
    <!--Style Switcher -->
    <script src="{{ asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
</body>

</html>
@extends('shop.layouts.page.info')




@section('content')




<div class="col-sm-12">
        <div class="white-box">
                
            <h3 class="box-title m-b-0">Thông tin tài khoản</h3>
            <p class="text-muted m-b-30 font-13">  </p>
            <form class="form" method="POST" action="{{route('edit-info')}}" enctype="multipart/form-data">
                @csrf
               
                <div class="form-group row">
                    <label for="hoten" class="col-2 col-form-label">Họ tên</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{ old('hoten') ? old('hoten') : Auth::user()->name }}" name="hoten" id="hoten">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-search-input" class="col-2 col-form-label">Giới tính</label>
                    <div class="col-6">
                        <input class="form-control" type="search" value="{{ Auth::user()->nam==1 ? "Nam" : "Nữ" }}" id="example-search-input" disabled="disabled">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Email</label>
                    <div class="col-6">
                        <input class="form-control" type="email" value="{{ Auth::user()->email }}" id="example-email-input" disabled="disabled">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diachi" class="col-2 col-form-label">Địa chỉ</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{ old('diachi') ? old('diachi') : Auth::user()->diachi }}" name="diachi" id="diachi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sdt" class="col-2 col-form-label">Số điện thoại</label>
                    <div class="col-6">
                        <input class="form-control" type="tel" value="{{ old('sdt') ? old('sdt') : Auth::user()->sdt }}" name="sdt" id="sdt">
                    </div>
                </div>
                
                
                
                
                <div class="col-sm-5" style="text-align: right;">
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-6" >Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('custom_plugin')
    <!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <!-- Summernote -->
    <link href="{{ asset('plugins/bower_components/summernote-master/dist/summernote-bs4.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/summernote-master/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote-master/lang/summernote-vi-VN.js') }}"></script>

    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 100,
            lang: 'vi-VN'
        });
    @if (session('success'))
        swal("Chúc mừng", "{{ session('success') }}", "success")
    @endif
    </script>

@endsection
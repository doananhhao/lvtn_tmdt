@extends('shop.layouts.page.info')




@section('content')




<div class="col-sm-12">
        <div class="white-box">
                @if (session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
                @endif
            <h3 class="box-title m-b-0">Thông tin tài khoản</h3>
            <p class="text-muted m-b-30 font-13">  </p>
            <form class="form"  action="">
                
                <div class="form-group row">
                    <label for="hoten" class="col-2 col-form-label">Họ tên</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{ Auth::user()->name }}" name="hoten" id="hoten">
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
                        <input class="form-control" type="text" value="{{ Auth::user()->diachi }}" name="diachi" id="diachi">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sdt" class="col-2 col-form-label">Số điện thoại</label>
                    <div class="col-6">
                        <input class="form-control" type="tel" value="{{ Auth::user()->sdt }}" name="sdt" id="sdt">
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="example-date-input" class="col-2 col-form-label">Ngày sinh</label>
                    <div class="col-6">
                        <input class="form-control" type="date" value="2011-08-19" id="example-date-input" disabled="disabled">
                    </div>
                </div>
                <div class="col-sm-5" style="text-align: right;">
                <button type="submit" class="btn btn-success waves-effect waves-light m-r-6" >Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

@endsection

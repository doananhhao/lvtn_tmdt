@extends('shop.layouts.page.info')




@section('content')




<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <small> Thông tin tài khoản</small>
                                    </div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="company" class=" form-control-label">Họ tên</label>
                                            <input type="text" id="company" value="{{ Auth::user()->name }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="vat" class=" form-control-label">Email</label>
                                            <input type="text" id="vat" value="{{ Auth::user()->email }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Giới tính</label>
                                            <input type="text" id="street" value="{{ Auth::user()->nam==1 ? "Nam" : "Nữ" }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Số điện thoại</label>
                                            <input type="text" id="street" value="{{ Auth::user()->sdt }} " class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="street" class=" form-control-label">Địa chỉ</label>
                                            <input type="text" id="street" value="{{ Auth::user()->diachi }} "  class="form-control">
                                        </div>
                                        <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-success btn-sm">Lưu thay đổi</button>
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
</div>
<div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
</div>
</div>
</div>
<div class="clearfix"></div>

@endsection

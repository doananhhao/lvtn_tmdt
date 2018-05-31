@extends('shop.layouts.page.info')




@section('content')




<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Đổi Mật Khẩu Mới</div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" class="">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-key"></i>
                                                    </div>
                                                    <input type="text" id="username" name="username" placeholder="Mật khẩu hiện tại" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <input type="email" id="email" name="email" placeholder="Mật khẩu mới" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-check-circle"></i>
                                                    </div>
                                                    <input type="password" id="password" name="password" placeholder="Nhập lại mật khẩu mới" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-actions form-group">
                                                <button type="submit" class="btn btn-success btn-sm">Đổi mật khẩu</button>
                                            </div>
                                        </form>
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

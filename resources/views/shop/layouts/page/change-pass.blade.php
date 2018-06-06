@extends('shop.layouts.page.info')




@section('content')




<div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Thay đổi mật khẩu</h3>
            <p class="text-muted m-b-30 font-13">  </p>
            <div class="row">
                <div class="col-sm-6 col-xs-12">
                    <form>
                        <div class="form-group">
                                <label for="exampleInputpwd">Mật khẩu cũ</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="ti-lock"></i></div>
                                    <input type="password" class="form-control" id="exampleInputpwd" placeholder="Mật khẩu hiện tại">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd1">Mật khẩu mới</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control" id="exampleInputpwd1" placeholder="Mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputpwd2">Nhập lại mật khẩu mới</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="ti-lock"></i></div>
                                <input type="password" class="form-control" id="exampleInputpwd2" placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                        <div class="col-sm-7" style="text-align: right;">
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('ql-tai-khoan.store') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group{{ $errors->has('loaiuser') ? ' has-danger' : '' }}">
                            <label for="loaiuser" class="col-md-12 text-muted">Loại tài khoản</label>
                            <div class="col-md-12">
                                <select class="selectpicker" name="loaiuser" id="loaiuser" data-style="form-control">
                                    @foreach($loaiuser as $v)
                                    {{-- Không có admin và người dùng --}}
                                    <option value="{{ $v->id }}"{{ old('loaiuser') == $v->id ? " selected":"" }}>{{ $v->tenloai }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('chucvu') ? ' has-danger' : '' }}">
                            <label for="chucvu" class="col-md-12 text-muted">Chức vụ <span class="text-primary">(Nếu là 'loại tài khoản' NHÂN VIÊN)</span></label>
                            <div class="col-md-12">
                                <select class="selectpicker" name="chucvu" id="chucvu" data-style="form-control">
                                    @foreach($chucvu as $v)
                                    <option value="{{ $v->id }}"{{ old('chucvu') == $v->id ? " selected":"" }}>{{ $v->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        
                        <div class="form-group{{ $errors->has('phongban') ? ' has-danger' : '' }}">
                            <label for="phongban" class="col-md-12 text-muted">Phòng ban <span class="text-primary">(Sử dụng nếu 'loại tài khoản' NHÂN VIÊN)</span></label>
                            <div class="col-md-12">
                                <select class="selectpicker" name="phongban" id="phongban" data-style="form-control">
                                    @foreach($phongban as $v)
                                    <option value="{{ $v->id }}"{{ old('phongban') == $v->id ? " selected":"" }}>{{ $v->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-md-12 text-muted">Email</label>
                            <div class="col-md-12">
                                <input type="text" name="email" class="form-control{{ $errors->has('email') ? ' form-control-danger' : '' }}" value="{{ old('email') }}" id="email" required="">
                                @if ($errors->has('email'))
                                <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="name" class="col-md-12 text-muted">Tên</label>
                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' form-control-danger' : '' }}" value="{{ old('name') }}" id="name" required="">
                                @if ($errors->has('name'))
                                <div class="form-control-feedback">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-md-12 text-muted">Mật khẩu (ít nhất 6 chữ số)</label>
                            <div class="col-md-12">
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' form-control-danger' : '' }}" id="password" required="">
                                @if ($errors->has('password'))
                                <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                            <label for="password_confirmation" class="col-md-12 text-muted">Xác nhận lại mật khẩu</label>
                            <div class="col-md-12">
                                <input type="password" name="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' form-control-danger' : '' }}" id="password_confirmation" required="">
                                @if ($errors->has('password_confirmation'))
                                <div class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>        

@endsection

@section('custom_plugin')
    <!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <!-- Select -->
    <link href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>

    <script>
        $('.selectpicker').selectpicker();

        @if(session()->has('success'))
        swal("Chúc mừng", "{{ session('success') }}", "success")
        @endif
    </script>
@endsection
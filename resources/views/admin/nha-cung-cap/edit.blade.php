@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('nha-cung-cap.update', ['id' => $ncc->id]) }}" method="POST" class="floating-labels ">
                        @csrf
                        @method('PUT')
                        <div class="form-group m-b-40{{ $errors->has('ten') ? ' has-error' : '' }}">
                            <input type="text" name="ten" class="form-control{{ $errors->has('ten') ? ' is-invalid' : '' }}" value="{{ old('ten') ? old('ten') : $ncc->ten }}" id="ten" required=""><span class="highlight"></span><span class="bar"></span>
                            <label for="ten">Tên nhà cung cấp</label>
                            <div class="help-block with-errors">
                                @if ($errors->has('ten'))
                                <ul class="list-unstyled">
                                    <li>{{ $errors->first('ten') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-b-40{{ $errors->has('diachi') ? ' has-error' : '' }}">
                            <input type="text" name="diachi" class="form-control" value="{{ old('diachi') ? old('diachi') : $ncc->diachi }}" id="diachi" required=""><span class="highlight"></span><span class="bar"></span>
                            <label for="diachi">Địa chỉ</label>
                            <div class="help-block with-errors">
                                @if ($errors->has('diachi'))
                                <ul class="list-unstyled">
                                    <li>{{ $errors->first('diachi') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-b-40{{ $errors->has('sdt') ? ' has-error' : '' }}">
                            <input type="text" name="sdt" class="form-control" value="{{ old('sdt') ? old('sdt') : $ncc->sdt }}" id="sdt" required=""><span class="highlight"></span><span class="bar"></span>
                            <label for="sdt">Số điện thoại</label>
                            <div class="help-block with-errors">
                                @if ($errors->has('sdt'))
                                <ul class="list-unstyled">
                                    <li>{{ $errors->first('sdt') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-rounded">Lưu thay đổi</button>
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

@if (session('success'))
<script>
    swal("Chúc mừng", "{{ session('success') }}", "success")
</script>
@endif

@endsection
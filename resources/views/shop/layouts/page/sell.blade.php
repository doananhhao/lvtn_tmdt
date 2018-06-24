@extends('shop.layouts.page.info')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('sell-product') }}" method="POST" class="form-horizontal">
                        @csrf
                        
                        <div class="form-group{{ $errors->has('tensanpham') ? ' has-danger' : '' }}">
                            <label for="tensanpham" class="col-md-12 text-muted">Tên sản phẩm</label>
                            <div class="col-md-12">
                                <input type="text" name="tensanpham" class="form-control{{ $errors->has('tensanpham') ? ' form-control-danger' : '' }}" value="{{ old('tensanpham') }}" id="tensanpham" required="">
                                @if ($errors->has('tensanpham'))
                                <div class="form-control-feedback">{{ $errors->first('tensanpham') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gia') ? ' has-danger' : '' }}">
                            <label for="gia" class="col-md-12 text-muted">Giá (VNĐ)</label>
                            <div class="col-md-12">
                                <input type="number" name="gia" class="form-control{{ $errors->has('gia') ? ' form-control-danger' : '' }}" value="{{ old('gia') }}" id="gia" required="" placeholder="1000000">
                                @if ($errors->has('gia'))
                                <div class="form-control-feedback">{{ $errors->first('gia') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('soluong') ? ' has-danger' : '' }}">
                            <label for="soluong" class="col-md-12 text-muted">Số lượng</label>
                            <div class="col-md-12">
                                <input type="number" name="soluong" class="form-control{{ $errors->has('soluong') ? ' form-control-danger' : '' }}" value="{{ old('soluong') ? old('soluong') : '0' }}" id="soluong" required="">
                                @if ($errors->has('soluong'))
                                <div class="form-control-feedback">{{ $errors->first('soluong') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="loaisp" class="col-md-12 text-muted">Loại sản phẩm</label>
                            <div class="col-md-12">
                                <select type="text" name="loaisp" class="custom-select col-12" id="loaisp">
                                    @foreach ($loaisp as $v)
                                    <option value="{{ $v->id }}" {{ old('loaisp') == $v->id ? "selected" : "" }}>{{ $v->tenloai }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('loaisp'))
                                <div class="form-control-feedback">{{ $errors->first('loaisp') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ncc" class="col-md-12 text-muted">Nhà cung cấp</label>
                            <div class="col-md-12">
                                <select type="text" name="ncc" class="custom-select col-12" id="ncc">
                                    @foreach ($ncc as $v)
                                    <option value="{{ $v->id }}" {{ old('ncc') == $v->id ? "selected" : "" }}>{{ $v->ten }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ncc'))
                                <div class="form-control-feedback">{{ $errors->first('ncc') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mota') ? ' has-danger' : '' }}">
                            <label for="mota" class="col-md-12 text-muted">Mô tả chi tiết</label>
                            <div class="col-md-12">
                                <textarea id="mota" name="mota" class='summernote form-control{{ $errors->has('mota') ? ' form-control-danger' : '' }}'>{!! old('mota') !!}</textarea>
                                @if ($errors->has('mota'))
                                <div class="form-control-feedback">{{ $errors->first('mota') }}</div>
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
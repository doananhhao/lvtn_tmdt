@extends('shop.layouts.page.info')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('sell-product') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                        <div class="form-group{{ $errors->has('thoigian') || session('date_error') ? ' has-danger' : '' }}">
                            <label for="thoigian" class="col-md-12 text-muted">Thời gian đăng bán</label>
                            <div class="col-md-12">   
                                <input type="text" class="form-control{{ $errors->has('thoigian') ? ' form-control-danger' : '' }} input-daterange-timepicker" name="thoigian" value="{{ old('thoigian') ? old('thoigian') : date('d/m/Y g:i A').' - '.date('d/m/Y g:i A')}}" />
                                @if ($errors->has('thoigian'))
                                <div class="form-control-feedback">{{ $errors->first('thoigian') }}</div>
                                @endif
                                @if (session('date_error'))
                                <div class="form-control-feedback">{{ session('date_error') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('img1') ? ' has-danger' : '' }}">
                            <label for="img1" class="col-md-12 text-muted">Hình ảnh (195x243)</label>
                            <div class="col-md-12">
                                <input type="file" name="img1" id="img1" class="dropify" data-default-file="">
                                {{--  <div class="checkbox checkbox-inverse">
                                        <input name="checkbox_img1" id="checkbox_img1" type="checkbox" value="img1">
                                        <label for="checkbox_img1"> Thêm hình </label>
                                    </div>  --}}
                                @if ($errors->has('img1'))
                                <div class="form-control-feedback">{{ $errors->first('img1') }}</div>
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
    <!-- Plugin JavaScript -->
    <script src="{{ asset('plugins/bower_components/moment/moment.js') }}"></script>
    <!-- Date picker plugins css -->
    <link href="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- Daterange picker plugins css -->
    <link href="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/bower_components/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <link href="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- jQuery file upload -->
    <link href="{{ asset('plugins/bower_components/dropify/dist/css/dropify.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/dropify/dist/js/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify();
        $( "input[type=checkbox]" ).prop('checked', true)
        $( "input[type=checkbox]" ).on( "click", function(e){
            var idimg = $(this).val()
            var checked = $(this).prop('checked')
            $('#' + idimg).prop('disabled', !checked) 
        });
    </script>

    <script>
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        locale: {
            format: 'DD/MM/YYYY h:mm A'
        },
        timePickerIncrement: 15,
        timePicker12Hour: true,
        timePickerSeconds: false,
        drops: 'up',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
</script>

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
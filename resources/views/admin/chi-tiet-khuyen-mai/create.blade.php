@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ route('loai-khuyen-mai.chi-tiet-khuyen-mai.store', ['loai-khuyen-mai' => $loaikm->id]) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group{{ $errors->has('sanpham_id') ? ' has-danger' : '' }}">
                            <label for="sanpham_id" class="col-md-12 text-muted">Sản phẩm</label>
                            <div class="col-md-12">
                                <select type="text" name="sanpham_id" class="custom-select col-12" id="sanpham_id">
                                    @foreach ($dssp as $v)
                                    @if ($v->DangBan()->first() == null)
                                    <option value="{{ $v->id }}" {{ old('sanpham_id') == $v->id ? "selected" : ""  }}>{{ $v->tensanpham }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('sanpham_id'))
                                <div class="form-control-feedback">{{ $errors->first('sanpham_id') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('giamgia') ? ' has-danger' : '' }}">
                            <label for="giamgia" class="col-md-12 text-muted">Giảm giá (%)</label>
                            <div class="col-md-12">
                                <input type="number" id="giamgia" name="giamgia" class='form-control{{ $errors->has('giamgia') ? ' form-control-danger' : '' }}' value="{{ old('giamgia')?old('giamgia'):'30' }}">
                                @if ($errors->has('giamgia'))
                                <div class="form-control-feedback">{{ $errors->first('giamgia') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('thoigian') || session('date_error') ? ' has-danger' : '' }}">
                            <label for="thoigian" class="col-md-12 text-muted">Chọn thời gian hiệu lực</label>
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
                        <div class="form-group{{ $errors->has('img') ? ' has-danger' : '' }}">
                            <label for="img" class="col-md-12 text-muted">Hình ảnh KHUYẾN MÃI ĐẶC BIỆT (270x334)</label>
                            <div class="col-md-12">
                                <input type="file" name="img" id="img" class="dropify" data-default-file="">
                                @if ($errors->has('img'))
                                <div class="form-control-feedback">{{ $errors->first('img') }}</div>
                                @endif
                            </div>
                        </div>
                        <a class="btn btn-default btn-outline pull-right" href='{{ route('loai-khuyen-mai.chi-tiet-khuyen-mai.index', ['loai-khuyen-mai' => $loaikm->id]) }}'>Quay lại {{ $loaikm->tenkhuyenmai }}</a>
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

    @if (session('success'))
        swal("Chúc mừng", "{{ session('success') }}", "success")
    @endif
    </script>

@endsection
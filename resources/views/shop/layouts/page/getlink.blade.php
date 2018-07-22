@extends('shop.layouts.page.info')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" action="{{ route('get_link') }}" method="POST" class="form-horizontal">
                        @csrf
                       
                        <div class="form-group{{ $errors->has('sanpham_id') ? ' has-danger' : '' }}">
                            <label for="sanpham_id" class="col-md-12 text-muted">Sản phẩm</label>
                            <div class="col-md-12">
                                <select type="text" name="sanpham_id" class="custom-select col-12" id="sanpham_id">
                                    @foreach ($dssp as $v)
                                    @if ($v->DangBan()->first() == null)
                                    
                                    <option value="{{ $v->id }}" {{ old('sanpham_id') == $v->id ? "selected" : "" }}>{{ $v->tensanpham }}</option>
                                
                                   
                                    
                                    @endif
                                    @endforeach
                                </select>
                                @if ($errors->has('sanpham_id'))
                                <div class="form-control-feedback">{{ $errors->first('sanpham_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Get Link</button>
                    </form>
                    
                </div>
                
                @if(session('linkhash'))
                <div class="col-md-12" style="margin-top: 25px">
                        <input type="text" name="link" id="link" class="form-control" value="{{ session('linkhash') }}">
                </div>
                @else
                <div class="col-md-12" style="margin-top: 25px">
                        <input type="text" name="link" id="link" class="form-control" value="{{ old('link')}}">
                </div>
                @endif
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
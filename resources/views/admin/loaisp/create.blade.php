@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('loai-san-pham.store') }}" method="POST" class="floating-labels ">
                        @csrf
                        <div class="form-group m-b-40{{ $errors->has('tenloai') ? ' has-error' : '' }}">
                            <input type="text" name="tenloai" class="form-control{{ $errors->has('tenloai') ? ' is-invalid' : '' }}" value="{{ old('tenloai') }}" id="tenloai" required=""><span class="highlight"></span><span class="bar"></span>
                            <label for="tenloai">Tên loại</label>
                            <div class="help-block with-errors">
                                @if ($errors->has('tenloai'))
                                <ul class="list-unstyled">
                                    <li>{{ $errors->first('tenloai') }}</li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-b-40{{ $errors->has('classfaicon') ? ' has-error' : '' }}">
                            <input type="text" name="classfaicon" class="form-control{{ $errors->has('classfaicon') ? ' is-invalid' : '' }}" value="{{ old('classfaicon') ? old('classfaicon') : 'icon fa fa-home fa-fw' }}" id="classfaicon" required=""><span class="highlight"></span><span class="bar"></span>
                            <label for="classfaicon">Font awesome ICON</label>
                            <div class="help-block with-errors">
                                @if ($errors->has('classfaicon'))
                                <ul class="list-unstyled">
                                    <li>{{ $errors->first('classfaicon') }}</li>
                                </ul>
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

@if (session('success'))
<script>
    swal("Chúc mừng", "{{ session('success') }}", "success")
</script>
@endif

@endsection
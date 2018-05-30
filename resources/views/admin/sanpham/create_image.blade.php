@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title"></h3>
            <p class="text-muted">Lưu ý: Chọn "Thêm hình" để lưu hình</p>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('san-pham.create_images', ['id' => $sp->id]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group{{ $errors->has('img1') ? ' has-danger' : '' }}">
                            <label for="img1" class="col-md-12 text-muted">Hình ảnh (195x243)</label>
                            <div class="col-md-12">
                                <input type="file" name="img1" id="img1" class="dropify" data-default-file="{{ $sp->hinhanh != "abc.jpg" ? asset('shop/images/pic/'.$sp->hinhanh) : "" }}">
                                <div class="checkbox checkbox-inverse">
                                        <input name="checkbox_img1" id="checkbox_img1" type="checkbox" value="img1">
                                        <label for="checkbox_img1"> Thêm hình </label>
                                    </div>
                                @if ($errors->has('img1'))
                                <div class="form-control-feedback">{{ $errors->first('img1') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('img2') ? ' has-danger' : '' }}">
                            <label for="img2" class="col-md-12 text-muted">Hình ảnh (100x120)</label>
                            <div class="col-md-12">
                                <input type="file" name="img2" id="img2" class="dropify" data-default-file="{{ $sp->hinhanh != "abc.jpg" ? asset('shop/images/pic/mh_'.$sp->hinhanh) : "" }}">
                                <div class="checkbox checkbox-inverse">
                                    <input name="checkbox_img2" id="checkbox_img2" type="checkbox" value="img2">
                                    <label for="checkbox_img2"> Thêm hình </label>
                                </div>
                                @if ($errors->has('img2'))
                                <div class="form-control-feedback">{{ $errors->first('img2') }}</div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Lưu thay đổi</button>
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

        @if (session('success'))
            swal("Chúc mừng", "{!! session('success') !!}", "success")
        @elseif (session('fail'))
            swal("Không thành công", "{{ session('fail') }}")
        @endif
    </script>
@endsection
@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box p-l-20 p-r-20">
            <h3 class="box-title">Email: <p class="text-muted">{{ $dangban->ThanhVien->User->email }}</p></h3>
            <b>Sản phẩm: <p class="text-muted">{{ $dangban->SanPham->tensanpham }}</p></b>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('dang-ban.update', ['id' => $dangban->id]) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-group{{ $errors->has('duyet') ? ' has-danger' : '' }}">
                            <label for="duyet" class="col-md-12 text-muted">Duyệt</label>
                            <div class="col-md-12">
                                <select type="text" name="duyet" class="custom-select col-12" id="duyet">
                                    @if (old('duyet'))
                                    <option value="1"{{ old('duyet') == 1 ? " selected" : "" }}>Đã duyệt</option>
                                    <option value="0"{{ old('duyet') == 0 ? " selected" : "" }}>Chưa duyệt</option>
                                    @else
                                    <option value="1"{{ $dangban->tinhtrang == 1 ? " selected" : "" }}>Đã duyệt</option>
                                    <option value="0"{{ $dangban->tinhtrang == 0 ? " selected" : "" }}>Chưa duyệt</option>
                                    @endif
                                </select>
                                @if ($errors->has('duyet'))
                                <div class="form-control-feedback">{{ $errors->first('duyet') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mota') ? ' has-danger' : '' }}">
                            <label for="mota" class="col-md-12 text-muted">Mô tả chi tiết</label>
                            <div class="col-md-12">
                                <textarea id="mota" name="mota" class='summernote form-control{{ $errors->has('mota') ? ' form-control-danger' : '' }}'>{!! old('mota') ? old('mota') : $dangban->mota !!}</textarea>
                                @if ($errors->has('mota'))
                                <div class="form-control-feedback">{{ $errors->first('mota') }}</div>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-rounded">Lưu thay đổi</button>
                        @if (!session('success'))
                        <a href="{{ url()->previous() }}#" class="btn btn-default btn-rounded">Quay lại</a>
                        @else
                        <a href="{{ route('dang-ban.index') }}#" class="btn btn-default btn-rounded">Danh sách sản phẩm</a>
                        @endif
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
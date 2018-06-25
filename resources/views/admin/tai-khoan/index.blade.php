@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">Loại tài khoản</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    {{-- <h5 class="m-t-10 m-b-10 text-danger">Trạng thái</h5> --}}
                    <select class="selectpicker" data-style="form-control" id="loaiuser">
                        <option value="0"{{ request()->has('loaiuser') ? "":" selected" }}>Tất cả</option>
                        @foreach($loaiuser as $v)
                        @if ($v->tenloai != "Quản trị viên")
                        <option value="{{ $v->id }}"{{ request()->has('loaiuser') == $v->id ? " selected":"" }}>{{ $v->tenloai }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">Trạng thái</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <select class="selectpicker" data-style="form-control" id="status">
                        <option value="-1">Tất cả</option>
                        <option value="1"{{ request()->has('status') == 1 ? " selected":"" }}>Hoạt động</option>
                        <option value="0"{{ request()->has('status') == 0 ? " selected":"" }}>Tạm khóa</option>
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>

    @if ($users->isEmpty())
    <div class="col-md-6 offset-md-3 col-sm-12">
        <div class="white-box text-center">
            <div class="alert alert-danger m-b-0">Không có dữ liệu cần tìm</div>
        </div>
    </div>
    @else
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Tài khoản</th>
                            <th>Trạng thái</th>
                            {{-- <th>Hành động</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr id="{{ $user->id }}">
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->sdt }}</td>
                            <td>{{ $user->LoaiUser->tenloai }}</td>
                            <td>
                                @if ($user->trangthai == 1)
                                <span class="label label-success">Hoạt động</span>
                                @else
                                <span class="label label-warning">Tạm khóa</span>
                                @endif
                            </td>
                            {{-- <td></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('custom_plugin')

    <!-- Select -->
    <link href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>

    <script>
    
    $('.selectpicker').selectpicker();
    $('select').on('change', function(){
        var loaiuser = $('#loaiuser')
        var status = $('#status')

        if (status.val() == -1){
            if (loaiuser.val() == 0)
                window.location.href = "{{ route('ql-tai-khoan.index') }}"
            else{
                window.location.href = "{{ route('ql-tai-khoan.index') }}?loaiuser=" + loaiuser.val()
            }
        }else{
            if (loaiuser.val() == 0)
                window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val()
            else{
                window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val() + "&loaiuser=" + loaiuser.val()
            }
        }
    })

    </script>

@endsection
@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">Trạng thái</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    {{-- <h5 class="m-t-10 m-b-10 text-danger">Trạng thái</h5> --}}
                    <select class="selectpicker" data-style="form-control" id="getList">
                        @if (request()->has('tinhtrang'))
                        <option value="2">Tất cả</option>
                        <option value="1"{{ request()->get('tinhtrang') == 1 ? " selected" : "" }}>Cho phép hiển thị</option>
                        <option value="0"{{ request()->get('tinhtrang') == 0 ? " selected" : "" }}>Không được hiển thị</option>
                        @else
                        <option value="2" selected>Tất cả</option>
                        <option value="1">Cho phép hiển thị</option>
                        <option value="0">Không được hiển thị</option>
                        @endif
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">Sản phẩm</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <select class="selectpicker" data-style="form-control" id="getListSP">
                        <option value="0">Tất cả</option>
                        @foreach($loaisp as $v)
                        <optgroup label="{{ $v->tenloai }}">
                            @foreach($v->SanPham as $sp)
                            @if ($sp->DangBan()->first() == null)
                            <option value="{{ $sp->id }}"{{ request()->get('sanpham') == $sp->id ? " selected" : "" }}>{{ $sp->tensanpham }}</option>
                            @endif
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>
    
    @if ($binhluan->isEmpty())
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
                <table class="table color-table success-table">
                    <col width="40px">
                    <col width="30%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nội dung</th>
                            <th>Sản phẩm</th>
                            <th>Tài khoản đăng</th>
                            <th>Tài khoản</th>
                            <th>Hiển thị</th>
                            <th>Ngày đăng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $styleLoaiUser = [
                            1 => 'label label-primary',
                            2 => 'label label-warning',
                            3 => 'label label-success',
                            4 => 'label label-default',
                        ]
                        @endphp
                        @foreach ($binhluan as $v)
                        <tr id="{{ $v->id }}">
                            <td style="vertical-align: middle;">{{ $v->id }}</td>
                            <td style="overflow:auto">{{ $v->noidung }}</td>
                            <td>{{ $v->SanPham->tensanpham }}</td>
                            <td>{{ $v->User->email }}</td>
                            <td>
                                <span class="{{ $styleLoaiUser[$v->User->LoaiUser->id] }}">{{ $v->User->LoaiUser->tenloai }}</span>
                            </td>
                            <td class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox"{{ $v->status == 1 ? " checked" : "" }} class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                            <td>{{ date('d-m-Y', strtotime($v->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $binhluan->links() }}
                </div>

            </div>
        </div>
    </div>
    @endif
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
    
    <!-- toast CSS -->
    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>

    <script>

    $('.selectpicker').selectpicker();
    $('select').on('change', function(){
        var getList = $('#getList')
        var getListSP = $('#getListSP')

        if (getList.val() == '2'){
            if (getListSP.val() == 0)
                window.location.href = "{{ route('binh-luan.index') }}"
            else{
                window.location.href = "{{ route('binh-luan.index') }}?sanpham=" + getListSP.val()
            }
        }else{
            if (getListSP.val() == 0)
                window.location.href = "{{ route('binh-luan.index') }}?tinhtrang=" + getList.val()
            else{
                window.location.href = "{{ route('binh-luan.index') }}?tinhtrang=" + getList.val() + "&sanpham=" + getListSP.val()
            }
        }
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(':checkbox').on('click', function(e){
        e.preventDefault()
        var input = $(this)
        var obj = {
            'id': input.parent().parent().parent().attr('id'),
            'status': input.prop("checked") ? 1 : 0 //sẽ trả về giá trị đổi sau khi click checkbox
        }
        console.log(obj)
        swal({   
            title: 'Xác nhận thay đổi trạng thái bình luận [#' + input.parent().parent().parent().attr('id') + '] ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes"
        }, function(confirmed){
            if (!confirmed)
                return;

            $.ajax({
                url: "{{ route('binh-luan.tinhtrang') }}",
                type: "GET",
                dataType: "json",
                data: obj,
                success: function(data){
                    if (data.success){
                        $.toast({
                            heading: 'Thay đổi trạng thái thành công',
                            text: data.message,
                            position: 'top-right',
                            bgColor:'#2ba55c',
                            icon: 'success',
                            hideAfter: 4000, 
                            stack: 6
                        });
                        input.prop("checked", data.checked)
                    }else{
                        swal("Lỗi", data.message)
                    }
                },
                error: function (data) {
                    swal("Lỗi", "Không thực hiện được do phát sinh lỗi")
                    console.log('Error:', data);
                }
            })
        })
    })
    
    </script>
@endsection
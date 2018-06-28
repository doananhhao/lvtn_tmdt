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
                        <option value="0"{{ request()->get('loaiuser') == 0 ? "":" selected" }}>Tất cả</option>
                        @foreach($loaiuser as $v)
                        {{-- @if ($v->tenloai != "Quản trị viên") --}}
                        <option value="{{ $v->id }}"{{ request()->get('loaiuser') == $v->id ? " selected":"" }}>{{ $v->tenloai }}</option>
                        {{-- @endif --}}
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
                        @if (request()->has('status'))
                        <option value="2">Tất cả</option>
                        <option value="1"{{ request()->get('status') == 1 ? " selected":"" }}>Hoạt động</option>
                        <option value="0"{{ request()->get('status') == 0 ? " selected":"" }}>Tạm khóa</option>
                        @else
                        <option value="2" selected>Tất cả</option>
                        <option value="1">Hoạt động</option>
                        <option value="0">Tạm khóa</option>
                        @endif
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>

    @if (request()->get('loaiuser') == App\Models\LoaiUser::where('tenloai', 'LIKE','%Nhân viên%')->first()->id)
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-warning">
            <div class="panel-heading">Phòng ban</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <select class="selectpicker" data-style="form-control" id="phongban">
                        <option value="0"{{ request()->has('phongban') ? "":" selected" }}>Tất cả</option>
                        @foreach($phongban as $pb)
                        <option value="{{ $pb->id }}"{{ request()->get('phongban') == $pb->id ? " selected":"" }}>{{ $pb->ten }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>
    @endif

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
                @if (!(request()->get('loaiuser') == App\Models\LoaiUser::where('tenloai', 'LIKE','%Nhân viên%')->first()->id))
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="font-bold">
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Tài khoản</th>
                            <th>Trạng thái</th>
                            {{-- <th>Hành động</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $style = [
                            1 => 'text-danger',
                            2 => 'text-primary',
                            3 => 'text-info',
                            4 => 'text-success',
                        ]
                        @endphp
                        @foreach($users as $user)
                        <tr id="{{ $user->id }}">
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->sdt }}</td>
                            <td>
                                @if (array_key_exists($user->LoaiUser->id, $style))
                                <span class="font-bold {{ $style[$user->LoaiUser->id] }}">{{ $user->LoaiUser->tenloai }}</span>
                                @else
                                <span class="font-bold text-mute">{{ $user->LoaiUser->tenloai }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->LoaiUser->tenloai == "Quản trị viên")
                                    <span class="text-danger m-l-20">None</span>
                                @else
                                    @if ($user->trangthai == 1)
                                    <span class="status label label-success" data-toggle="tooltip" data-original-title="Chọn để đổi trạng thái">Hoạt động</span>
                                    @else
                                    <span class="status label label-warning" data-toggle="tooltip" data-original-title="Chọn để đổi trạng thái">Tạm khóa</span>
                                    @endif
                                @endif
                            </td>
                            {{-- <td></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                @include('admin.tai-khoan.index_nhanvien')
                @endif
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
    
    <style>
    .status, .pointer{
        cursor: pointer;
    }
    .status:hover{
        transition: 0.5s;
        color: black;
    }
    </style>

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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.selectpicker').selectpicker();

    var nhanvien_id = 0
    $('.thaydoi_nv').on('click', function(){
        var modal = $('#ajax-modal')
        var element = $(this)
        var selectPB = $('#getListPB')
        var selectCV = $('#getListCV')
        selectPB.empty()
        selectCV.empty()
        nhanvien_id = element.parent().parent().attr('id')
        $('#modal-title-id').find('span').html(element.parent().parent().find('td:nth-child(2)').html())
        $('#modal-nv-email').find('span').html(element.parent().parent().find('td:nth-child(1)').html())
        $.ajax({
            url: '{{ route('ql-tai-khoan.get_nv') }}',
            type: 'GET',
            dataType: 'json',
            data: {
                'nhanvien_id': nhanvien_id
            },
            success: function(data){
                if (!data.success){
                    swal("Không thành công", data.message)
                    return;
                }
                if (data.pb)
                    $.each(data.pb, function(key, value){
                        selectPB.append($("<option/>", {
                            value: value.id,
                            text: value.ten
                        }));
                    })
                if (data.chucvu)
                    $.each(data.chucvu, function(key, value){
                        selectCV.append($("<option/>", {
                            value: value.id,
                            text: value.ten
                        }));
                    })
                if (data.selected_pb)
                    selectPB.val(data.selected_pb).change()
                if (data.selected_cv)
                    selectCV.val(data.selected_cv).change()
                $('.selectpicker').selectpicker('refresh');
                modal.modal('show')
            },error: function(data){
                console.log(data)
            }
        })
    })
    $('#savechanges').on('click', function(){
        var modal = $('#ajax-modal')
        var element = $('#' + nhanvien_id)
        swal({   
            title: 'Xác nhận thực hiện?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Xác nhận"
        }, function(confirmed){
            if (!confirmed)
                return;
            $.ajax({
                url: '{{ route('ql-tai-khoan.change_nv') }}',
                type: "GET",
                dataType: "json",
                data: {
                    'nhanvien_id': nhanvien_id,
                    'phongban_id': $('#getListPB').val(),
                    'chucvu_id': $('#getListCV').val()
                },
                success: function(data){
                    if (!data.success){
                        swal("Xảy ra lỗi", data.message)
                        return;
                    }
                    if (data.old_tp){
                        $('#' + data.old_tp).find('td:nth-child(4)').find('span').removeClass().addClass(data.class_nv).html(element.find('td:nth-child(4)').find('span').html())
                    }
                    element.find('td:nth-child(4)').find('span').removeClass().addClass(data.current_cv == "Trưởng phòng" ? data.class_tp : data.class_nv).html(data.current_cv)
                    element.find('td:nth-child(5)').html(data.current_pb)

                    var message = "Đổi nhân viên"
                    message += " [" + element.find('td:nth-child(2)').html() + "]"
                    message += " thành [" + data.current_cv + "] [" + data.current_pb + "]."
                    if (data.old_tp)
                        message += " Đổi trưởng phòng cũ thành [Nhân viên]."
                    $.toast({
                        heading: 'Thay đổi thành công',
                        text: message,
                        position: 'top-right',
                        bgColor:'#2ba55c',
                        icon: 'success',
                        hideAfter: 4000, 
                        stack: 6
                    });

                    modal.modal('hide')
                },error: function(data){
                    console.log(data);
                }
            })
        })
    })

    $('.status').on('click', function(){
        var status = $(this)

        swal({   
            title: 'Xác nhận đổi trạng thái tài khoản [' + status.parent().parent().find('td:nth-child(1)').html() + '] ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes"
        }, function(confirmed){
            if (!confirmed)
                return;

            $.ajax({
                url: '{{ route('ql-tai-khoan.change_user_status') }}',
                type: "GET",
                dataType: "json",
                data: {
                    'user_id': status.parent().parent().attr('id')
                },
                success: function(data){
                    if (data.success){
                        status.removeClass()
                        if (data.status == 1){
                            status.addClass('status label label-success')
                            status.html('Hoạt động')
                        }else if (data.status == 0){
                            status.addClass('status label label-warning')
                            status.html('Tạm khóa')
                        }
                        
                        $.toast({
                            heading: 'Thay đổi thành công',
                            text: data.message,
                            position: 'top-right',
                            bgColor:'#2ba55c',
                            icon: 'success',
                            hideAfter: 4000, 
                            stack: 6
                        });
                    }else{
                        swal("Xảy ra lỗi", data.message)
                    }
                },error: function(data){
                    console.log(data);
                }
            })
        })
    })

    $('select').on('change', function(){
        var loaiuser = $('#loaiuser')
        var status = $('#status')
        var phongban = $('#phongban')
        if ($(this).attr('id') != 'loaiuser' && $(this).attr('id') != 'status' && $(this).attr('id') != 'phongban')
            return;
        if (status.val() == 2){
            if (loaiuser.val() == 0)
                if ((typeof phongban.val() !== "undefined") && phongban.val() != 0)
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?phongban=" + phongban.val() 
                else{
                    window.location.href = "{{ route('ql-tai-khoan.index') }}" 
                }
            else{
                if ((typeof phongban.val() !== "undefined") && phongban.val() != 0)
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?loaiuser=" + loaiuser.val() + "&phongban=" + phongban.val()
                else
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?loaiuser=" + loaiuser.val()
            }
        }else{
            if (loaiuser.val() == 0)
                if ((typeof phongban.val() !== "undefined") && phongban.val() != 0)
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val() + "&phongban=" + phongban.val()
                else
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val()
            else{
                if ((typeof phongban.val() !== "undefined") && phongban.val() != 0)
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val() + "&loaiuser=" + loaiuser.val()  + "&phongban=" + phongban.val()
                else
                    window.location.href = "{{ route('ql-tai-khoan.index') }}?status=" + status.val() + "&loaiuser=" + loaiuser.val()
            }
        }
    })

    </script>

@endsection
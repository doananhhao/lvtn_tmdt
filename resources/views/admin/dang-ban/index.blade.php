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
                        @if (request()->has('dangban'))
                        <option value="0">Tất cả</option>
                        <option value="moi"{{ request()->get('dangban') == 'moi' ? " selected" : "" }}>Yêu cầu mới</option>
                        <option value="daduyet"{{ request()->get('dangban') == 'daduyet' ? " selected" : "" }}>Đã được hiển thị đăng bán</option>
                        @else
                        <option value="0" selected>Tất cả</option>
                        <option value="moi">Yêu cầu mới</option>
                        <option value="daduyet">Đã được hiển thị đăng bán</option>
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
                        {{-- <optgroup label="{{ $v->tenloai }}"> --}}
                            {{-- @foreach($v->SanPham as $sp) --}}
                            <option value="{{ $v->id }}"{{ request()->get('loaisp') == $v->id ? " selected" : "" }}>{{ $v->tenloai }}</option>
                            {{-- @endforeach --}}
                        {{-- </optgroup> --}}
                        @endforeach
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>
    
    @if ($dangban->isEmpty())
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
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Sản phẩm</th>
                            <th>Mô tả thêm</th>
                            <th data-toggle="tooltip" data-original-title="Cấp độ thành viên">Cấp</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th>Status</th>
                            {{-- <th class="text-center">Hiển thị</th> --}}
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dangban as $v)
                        <tr id="{{ $v->id }}">
                            <td>{{ $v->ThanhVien->User->email }}</td>
                            <td>{{ $v->SanPham->tensanpham }}</td>
                            <td>
                                @if ($v->mota == null || $v->mota == "")
                                <span class='text-warning'>Trống</span>
                                @else
                                <span class='text-info'>{{ $v->mota }}</span>
                                @endif
                            </td>
                            <td>{{ $v->ThanhVien->CapDo ? $v->ThanhVien->CapDo->capdo : "Chưa có" }}</td>
                            <td>{{ date('d-m-Y', strtotime($v->created_at)) }}</td>
                            @if (strtotime($v->ngayhethan) > strtotime(date('Y-m-d H:i:s')))
                            <td>{{ date('d-m-Y', strtotime($v->ngayhethan)) }}</td>
                            @else
                            <td><span class="label label-danger">{{ date('d-m-Y H:i:s', strtotime($v->ngayhethan)) }}</span></td>
                            @endif
                            <td>
                                {{-- Khi canduyet = true (có thể chưa có history), nhưng khi canduyet = false, chắc chắn đã có history --}}
                                @if($v->canduyet == true)
                                <span class="label label-table label-warning">Đang duyệt</span>
                                @elseif($v->DuyetDangBanHistory->sortByDesc('id')->first()->status == 0)
                                <span class="label label-table label-danger">Từ chối</span>
                                @else
                                <span class="label label-table label-success">Cho phép</span>
                                @endif
                            </td>
                            {{-- <td class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox"{{ $v->tinhtrang == 1 ? " checked" : "" }} value="{{ $v->id }}" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td> --}}
                            <td>
                                {{-- class hidden, không hiển thị --}}
                                @if($v->canduyet == true || $v->DuyetDangBanHistory->sortByDesc('id')->first()->status == 0)
                                    <a class="allow" data-toggle="tooltip" data-original-title="Cho phép đăng bán"> <i class="fa fa-check text-success m-r-10"></i> </a>

                                    <a class="deny hidden" data-toggle="tooltip" data-original-title="Xóa yêu cầu"> <i class="fa fa-close text-danger m-r-10"></i> </a>
                                @endif
                                @if($v->canduyet == true || $v->DuyetDangBanHistory->sortByDesc('id')->first()->status == 1)
                                    <a class="allow hidden" href="#" data-toggle="tooltip" data-original-title="Cho phép đăng bán"> <i class="fa fa-check text-success m-r-10"></i> </a>

                                    <a class="deny" href="#" data-toggle="tooltip" data-original-title="Xóa yêu cầu"> <i class="fa fa-close text-danger m-r-10"></i> </a>
                                @endif
                                
                                {{-- <a href="{{ route('dang-ban.edit', ['id' => $v->id]) }}" data-toggle="tooltip" data-original-title="Xem thông tin chi tiết"> <i class="fa fa-info text-inverse m-r-10"></i> </a> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $dangban->links() }}
                </div>

                <div id="ajax-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="margin-top:200px">
                            <div class="modal-header">
                                <h4 class="modal-title" id='modal-title-id'>YÊU CẦU ĐĂNG BÁN <span class="text-danger"></span></h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="comments" class="control-label">Lời nhắn cho người đăng bán (Nếu có):</label>
                                        <textarea class="form-control" id="comments"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light" id="savechanges">Thực Hiện</button>
                            </div>
                        </div>
                    </div>
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

    var dangban_id = 0, action = null

    $('.selectpicker').selectpicker();
    $('select').on('change', function(){
        var getList = $('#getList')
        var getListSP = $('#getListSP')

        if (getList.val() == '0'){
            if (getListSP.val() == 0)
                window.location.href = "{{ route('dang-ban.index') }}"
            else{
                window.location.href = "{{ route('dang-ban.index') }}?loaisp=" + getListSP.val()
            }
        }else{
            if (getListSP.val() == 0)
                window.location.href = "{{ route('dang-ban.index') }}?dangban=" + getList.val()
            else{
                window.location.href = "{{ route('dang-ban.index') }}?dangban=" + getList.val() + "&loaisp=" + getListSP.val()
            }
        }
    })

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.allow, .deny').on('click', function(e){
        e.preventDefault()
        var email_nguoi_ban = $(this).parent().parent().find('td:nth-child(1)').html()
        dangban_id = $(this).parent().parent().attr('id')
        action = null
        animate()
        if ($(this).hasClass('allow'))
            action = "allow"
        else if ($(this).hasClass('deny'))
            action = "deny"
        
        if (typeof email_nguoi_ban === undefined || action == null)
            location.reload()
        
        $('#modal-title-id').find('span').html(email_nguoi_ban)
        $('#savechanges').html(action == 'allow' ? "Đồng ý" : "Từ chối")
        $('#ajax-modal').modal('show');
    })

    $('#savechanges').on('click', function(e){
        var comment = $('#comments').val()
        $.ajax({
            url: '{{ route('dang-ban.tinhtrang') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                'dangban_id': dangban_id,
                'action': action,
                'comment': comment ? comment : ""
            },
            success: function(data){
                if (data.success){
                    changeStatusDB(action)
                    changAtag(action)
                    $.toast({
                        heading: 'Xử lý thành công',
                        text: data.message,
                        position: 'top-right',
                        bgColor:'#2ba55c',
                        icon: 'success',
                        hideAfter: 4000, 
                        stack: 6
                    });
                    animate()
                }else{
                    swal("Xảy ra lỗi", data.message)
                }
            },error: function(data){
                console.log('error: Lỗi khi [' + action + '] yêu cầu đăng bán')
                console.log(data)
            }
        })
        $('#ajax-modal').modal('hide');
    })

    function animate(){
        $('#' + dangban_id).addClass('flash animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
            $(this).removeClass();
        });
    }

    function changAtag(action){
        var atag = $('#' + dangban_id).find('td:nth-child(8)')
        var status = $('#' + dangban_id).find('td:nth-child(7)').find('span')
        if (status.html() === "Đang duyệt")
            return false;

        var arrAction = ['deny', 'allow']
        var arrReverse = [].concat(arrAction)
        arrReverse.reverse()
        var index = arrAction.indexOf(action)
        if (index != -1){
            atag.find(`.${arrAction[index]}`).addClass('hidden')
            atag.find(`.${arrReverse[index]}`).removeClass('hidden')
            return true;
        }
        return false;
    }

    function changeStatusDB(action){
        var status = $('#' + dangban_id).find('td:nth-child(7)')
        var arr = ['Cho phép', 'Từ chối']
        var arrAction = ['allow', 'deny']
        var arrClass = ['label label-table label-success', 'label label-table label-danger']

        var index = arrAction.indexOf(action)
        if (index != -1){
            status.html(`<span class="${arrClass[index]}">${arr[index]}</span>`)
            return true;
        }
        return false;
    }
    </script>
@endsection
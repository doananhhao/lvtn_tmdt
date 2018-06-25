@extends('admin.layouts.index')

@section('content')

<div class="row">

    @if ($cdhd->isEmpty())
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
                            <th>Mã hóa đơn</th>
                            <th>Email người mua</th>
                            <th>Sản phẩm</th>
                            {{-- <th>Ngày đặt hàng</th> --}}
                            <th>Ngày nhận việc</th>
                            <th>Nhân viên</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cdhd as $v)
                        <tr>
                            <td class="text-danger"><b>#{{ $v->HoaDon->id }}</b></td>
                            <td>{{ $v->HoaDon->User->email }}</td>
                            <td>
                                @foreach ($v->HoaDon->ChiTietHoaDon as $cthd)
                                {{ $cthd->SanPham->tensanpham}}<small class="p-l-10 text-primary"> x {{$cthd->SanPham->soluong }}</small>
                                <br>
                                @endforeach
                            </td>
                            {{-- <td>{{ date('d-m-Y', strtotime($v->HoaDon->created_at)) }}</td> --}}
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}</td>
                            <td>
                                @if ($v->HoaDon->PhanCong->sortByDesc('id')->first() != null &&
                                    $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $v->congdoan_id)
                                    {{-- Đã phân công --}}
                                    @if ($v->HoaDon->PhanCong->sortByDesc('id')->first()->status == 1)
                                    <span class="label label-success">
                                        {{ $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->User->name }}
                                    </span>
                                    @else
                                    <span class="label label-warning">
                                        {{ $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->User->name }}
                                    </span>
                                    @endif
                                @else
                                <span class="text-mute">Chưa phân công</span>
                                @endif
                            </td>
                            <td id="{{ $v->HoaDon->id }}">
                                {{-- <a href="#" data-toggle="tooltip" data-original-title="Chi tiết hóa đơn"> 
                                    <i class="fa fa-list-ul text-inverse m-r-10"></i> 
                                </a> --}}

                                @if ($v->HoaDon->PhanCong->sortByDesc('id')->first() != null &&
                                    $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $v->congdoan_id)
                                    {{-- Đã phân công --}}
                                    @if ($v->HoaDon->PhanCong->sortByDesc('id')->first()->status == 1)

                                    <a href="#" class="successWarning"data-toggle="tooltip" data-original-title="Hoàn thành"> 
                                        <i class="fa fa-check-square-o text-success m-r-10"></i> 
                                    </a>

                                    @endif
                                @endif

                                <a href="#" data-toggle="tooltip" class="phancong" id='{{ $v->HoaDon->id }}_{{ $v->id }}' data-original-title="Phân công / phân công lại"> 
                                    <i class="fa fa-edit text-inverse m-r-10"></i> 
                                </a>

                                @if ($phongban->ten == "Phòng kiểm tra")
                                <a href="#" data-toggle="tooltip" class='deleteWarning' data-original-title="Hủy hóa đơn"> 
                                    <i class="fa fa-trash-o text-danger m-r-10"></i> 
                                </a>
                                @elseif ($v->HoaDon->PhanCong->sortByDesc('id')->first() != null &&
                                        $v->HoaDon->PhanCong->sortByDesc('id')->first()->status == 1 && 
                                        $v->HoaDon->PhanCong->sortByDesc('id')->first()->NhanVien->PhongBan->CongDoan()->first()->id == $v->congdoan_id)
                                @php
                                $pb_truoc = App\Models\PhongBan::find($phongban->id - 1);
                                @endphp
                                <a href="#" data-toggle="tooltip" class='reworkWarning' data-original-title="Yêu cầu [{{ $pb_truoc->ten }}] xử lý lại"> 
                                    <i class="fa fa-refresh text-inverse m-r-10"></i>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pull-right">
                    {{ $cdhd->links() }}
                </div>
            </div>

            <div id="ajax-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content" style="margin-top:200px">
                        <div class="modal-header">
                            <h4 class="modal-title" id='modal-title-id'>HÓA ĐƠN <span class="text-danger"></span></h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="getListNV" class="control-label">Nhân viên:</label>
                                    <select class="selectpicker" data-style="form-control" id="getListNV">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comments" class="control-label">Ghi chú (Nếu có):</label>
                                    <textarea class="form-control" id="comments"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" id="savechanges">Phân công</button>
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
    var idhd_idcdhd = null
    $('#savechanges').on('click', function(){
        // console.log('save ' + idhd_idcdhd)
        var id_nv = $('.selectpicker').val()
        var cmt = $('#comments').val()
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
            url: '{{ route('hoa-don.phancongnv') }}',
			type: "POST",
			dataType: "json",
			data: {
                'id_nv': id_nv,
                'cmt': cmt,
                'idhd_idcdhd': idhd_idcdhd
            },
            success: function(data){
                if (!data.success)
                {
                    swal("Xảy ra lỗi", data.message)
                    return;
                }
                var element = $('#' + idhd_idcdhd).parent().parent().find('td:nth-child(5)')
                element.html(`<span class="label label-warning">${$('.selectpicker option:selected').text()}</span>`)
                // swal("Đã lưu", data.message, "success")
                $.toast({
                    heading: 'Phân công thành công',
                    text: data.message,
                    position: 'top-right',
                    bgColor:'#2ba55c',
                    icon: 'success',
                    hideAfter: 4000, 
                    stack: 6
                });
                $('#ajax-modal').modal('hide');
            },
            error: function(data){
                console.log('error: Phân công không thành công')
            }
        })
    })
    $('.phancong').on('click', function(e){
        var id = $(this).attr('id')
        idhd_idcdhd = id
        var select = $('#getListNV')
        select.empty()
        var cmt = $('#comments')
        $('#modal-title-id > span').html($(this).parent().parent().find('td:nth-child(1)>b').text())
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        $.ajax({
            url: '{{ route('hoa-don.dsnvpc') }}',
			type: "GET",
			dataType: "json",
			data: {
                'id': id
            },
            success: function(data){
                if (!data.success){
                    swal("Không thành công", data.message)
                    return;
                }
                if (data.dsnv)
                    $.each(data.dsnv, function(key, value){
                        select.append($("<option/>", {
                            value: key,
                            text: value
                        }));
                    })
                $('#comments').val("")
                if (data.selected){
                    select.val(data.selected).change()
                    cmt.val(data.comments)
                }
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(data){
                console.log('error: Không thể sử dụng, phân công lỗi')
            }
        })
        $('#ajax-modal').modal('show');
    })
    $('.successWarning').on('click', function(e){
        var hoadon_id = $(this).parent().attr('id')
        e.preventDefault();
        var element = $(this)
        swal({   
            title: 'Đánh dấu hoàn thành công đoạn này cho hóa đơn #' + hoadon_id + '?',
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes"
        }, function(confirmed){
            if (!confirmed)
                return;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('hoa-don.htcdhd') }}',
                type: "GET",
                dataType: "json",
                data: {
                    'hoadon_id': hoadon_id
                },
                success: function(data){
                    if (!data.success){
                        swal("Không thành công", data.message)
                        return;
                    }
                    // swal("Thành công", data.message, "success")
                    $.toast({
                        heading: 'Đặt trang thái hóa đơn',
                        text: data.message,
                        position: 'top-right',
                        bgColor:'#2ba55c',
                        icon: 'success',
                        hideAfter: 4000, 
                        stack: 6
                    });
                    element.parent().parent().remove()
                    // setTimeout(function(){
                    //     location.reload();
                    // }, 2500)
                },
                error: function(data){
                    console.log('error: Lỗi {{ $phongban->ten == "Phòng kiểm tra"?"hủy":"yêu cầu phản hồi"}} hóa đơn')
                }
            })
        });
    })
    $('.{{ $phongban->ten == "Phòng kiểm tra"?"deleteWarning":"reworkWarning"}}').on('click', function(e){
        var hoadon_id = $(this).parent().attr('id')
        e.preventDefault();
        var element = $(this)
        
        swal({   
            title: 'Bạn có muốn {{ $phongban->ten == "Phòng kiểm tra"?"hủy hóa đơn?":"yêu cầu xử lý lại hóa đơn?"}}',
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Yes"
        }, function(confirmed){
            if (!confirmed)
                return;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ $phongban->ten == "Phòng kiểm tra"?route('hoa-don.huy'):route('hoa-don.rework') }}',
                type: "GET",
                dataType: "json",
                data: {
                    'hoadon_id': hoadon_id
                },
                success: function(data){
                    if (!data.success){
                        swal("Không thành công", data.message)
                        return;
                    }
                    this.hideAlert
                    // swal("Thành công", data.message, "success")
                    $.toast({
                        heading: 'Yêu cầu thành công',
                        text: data.message,
                        position: 'top-right',
                        bgColor:'#2ba55c',
                        icon: 'success',
                        hideAfter: 4000, 
                        stack: 6
                    });
                    element.parent().parent().remove()
                    // setTimeout(function(){
                    //     location.reload();
                    // }, 2500)
                },
                error: function(data){
                    console.log('error: Cập nhật trạng thái [hoàn thành công đoạn] cho hóa đơn bị lỗi')
                }
            })
        });
    })
    </script>
@endsection
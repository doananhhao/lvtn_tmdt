@extends('admin.layouts.index')

@section('content')

<div class="row">

    @if ($dspc->isEmpty())
    <div class="col-md-6 offset-md-3 col-sm-12">
        <div class="white-box text-center">
            <div class="alert alert-success m-b-0">Hiện thời chưa có hóa đơn cần làm</div>
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
                            <th>Ghi chú (Khách)</th>
                            @if (Auth::User()->NhanVien->PhongBan->ten == "Phòng vận chuyển")
                            <th>Địa chỉ</th>
                            <th>Điện thoại</th>
                            @endif
                            <th>Sản phẩm</th>
                            <th>Ngày nhận việc</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dspc as $pc)
                        <tr id="{{ $pc->id }}">
                            <td class="text-danger"><b>{{ '#'.$pc->hoadon_id }}</b></td>
                            <td>{{ $pc->HoaDon->mota != "" ? $pc->HoaDon->mota : "[Không có]" }}</td>
                            @if (Auth::User()->NhanVien->PhongBan->ten == "Phòng vận chuyển")
                            <td>{{ $pc->HoaDon->diachi }}</td>
                            <td>{{ $pc->HoaDon->sdt }}</td>
                            @endif
                            <td>
                                @foreach ($pc->HoaDon->ChiTietHoaDon as $cthd)
                                {{ $cthd->SanPham->tensanpham}}<small class="p-l-10 text-primary"> x {{$cthd->SanPham->soluong }}</small>
                                <br>
                                @endforeach
                            </td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($pc->created_at)) }}</td>
                            <td>
                                <a href="#" class="modalBaoCao"data-toggle="tooltip" data-original-title="Báo cáo lại cho trưởng phòng"> 
                                    <i class="fa fa-check-square-o text-success m-l-10"></i> 
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pull-right">
                    {{ $dspc->links() }}
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
                                    <label for="comments" class="control-label m-t-10 text-primary">Ghi chú (Phản hồi cho trưởng phòng nếu cần):</label>
                                    <textarea class="form-control m-t-10" id="comments" rows="5"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light" id="report">Báo cáo</button>
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

    <!-- toast CSS -->
    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var phancong_id = null;
        var hoadon_id = null;

        $('#report').on('click', function(e){
            e.preventDefault();
            if (!phancong_id)
                return;
            var comments = $('#comments').val()
            var element = $("#" + phancong_id)
            swal({   
                title: 'Bạn xác nhận gửi báo cáo công việc này?',
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Yes"
            }, function(confirmed){
                if (!confirmed)
                    return;
                $.ajax({
                    url: '{{ route('hoa-don.baocaocv') }}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'phancong_id': phancong_id,
                        'comments' : comments
                    },
                    success: function(data){
                        if (!data.success){
                            swal('LỖI', data.message)
                            return;
                        }
                        $.toast({
                            heading: 'Hoàn thành',
                            text: data.message,
                            position: 'top-right',
                            bgColor:'#2ba55c',
                            icon: 'success',
                            hideAfter: 4000, 
                            stack: 6
                        });
                        element.remove()
                        $('#ajax-modal').modal('hide');
                    },
                    error: function(data){
                        console.log('error: Lỗi gửi báo cáo công việc')
                        console.log(data)
                    }
                })
            });
        })

        $('.modalBaoCao').on('click', function(e){
            e.preventDefault();
            phancong_id = $(this).parent().parent().attr('id') 
            hoadon_id = $(this).parent().parent().find('td:nth-child(1)>b').text().substring(1)
            var cmt = $('#comments')
            cmt.val('')
            $('#modal-title-id > span').html("#" + hoadon_id)
            console.log(phancong_id)
            $.ajax({
                url: '{{ route('hoa-don.chitietpc') }}',
                type: "GET",
                dataType: "json",
                data: {
                    'phancong_id': phancong_id
                },
                success: function(data){
                    if (!data.success){
                        swal('LỖI', data.message)
                        return;
                    }
                    cmt.val(data.comments)
                    $('#ajax-modal').modal('show');
                },
                error: function(data){
                    console.log('error: Lỗi load dữ liệu công việc')
                    console.log(data)
                }
            })
        })
    </script>

@endsection
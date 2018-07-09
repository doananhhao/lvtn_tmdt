@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12 offset-sm-0">
        <div class="panel panel-default">
            <div class="panel-heading text-center">Thông tin khuyến mãi</div>
            <div class="panel-wrapper collapse in">
                <table class="table table-hover">
                    {{-- <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead> --}}
                    <tbody>
                        <tr>
                            <td class="text-danger bg-inverse">Tên khuyến mãi</td>
                            <td class="text-center">{{ $loaikm->tenkhuyenmai }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Số sản phẩm</td>
                            <td class="text-center">{{ count($loaikm->chitietkhuyenmai) }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Ngày tạo</td>
                            <td class="text-center">{{ date('d-m-Y H:i:s', strtotime($loaikm->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Ngày cập nhật</td>
                            <td class="text-center">{{ date('d-m-Y H:i:s', strtotime($loaikm->updated_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Hành động</td>
                            <td class="text-center">
                                <form id="form{{ $loaikm->id }}loai" action="{{ route('loai-khuyen-mai.destroy', ['id' =>$loaikm->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('loai-khuyen-mai.edit', ['id' => $loaikm->id]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="{{ route('loai-khuyen-mai.destroy', ['id' =>$loaikm->id]) }}" id='orm{{ $loaikm->id }}loai' class='deleteWarning' data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <button class="fcbtn btn btn-success btn-outline btn-1f" onclick="window.location.href='{{route('loai-khuyen-mai.chi-tiet-khuyen-mai.create', ['loai_khuyen_mai' => $loaikm->id])}}'"><i class="fa fa-plus" aria-hidden="true"></i></button>
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="table-responsive">
                <table class="table color-table success-table">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Khuyến mãi</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>       
                            <th>Hành động</th>                     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ctkm as $v)
                        <tr>
                            <td>{{ $v->SanPham->tensanpham }}</td>
                            {{-- <td>{{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}</td> --}}
                            <td>{{ $v->giamgia*100 }}%</td>
                            @if (strtotime($v->ngayketthuc) > strtotime(date('Y-m-d H:i:s')))
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->ngaybd)) }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->ngayketthuc)) }}</td>
                            @else
                            <td><span class="label label-danger">{{ date('d-m-Y H:i:s', strtotime($v->ngaybd)) }}</span></td>
                            <td><span class="label label-danger">{{ date('d-m-Y H:i:s', strtotime($v->ngayketthuc)) }}</span></td>
                            @endif
                            <td>
                                <form id="form{{ $v->id }}" action="{{ route('loai-khuyen-mai.chi-tiet-khuyen-mai.destroy', ['loai_khuyen_mai' => $loaikm->id, 'chi-tiet-khuyen-mai' => $v->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('loai-khuyen-mai.chi-tiet-khuyen-mai.edit', ['loai_khuyen_mai' => $loaikm->id, 'chi-tiet-khuyen-mai' => $v->id]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="{{ route('loai-khuyen-mai.chi-tiet-khuyen-mai.destroy', ['loai_khuyen_mai' => $loaikm->id, 'chi-tiet-khuyen-mai' => $v->id]) }}" id='orm{{ $v->id }}' class='deleteWarning' data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $ctkm->links() }}
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

<script>
$('.deleteWarning').on('click', function(e){
    var id = $(this).attr('id')
    var href = $(this).attr('href')
    e.preventDefault();
    swal({   
        title: "Bạn có muốn xóa?",
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes",   
        closeOnConfirm: false
    }, function(confirmed){
        if (!confirmed)
            return;
        document.getElementById('f' + id).submit();
    });
})

@if (session('success'))
    swal("Chúc mừng", "{{ session('success') }}", "success")
@elseif (session('fail'))
    swal("Không thể xóa!", "{{ session('fail') }}")
@endif
</script>
@endsection
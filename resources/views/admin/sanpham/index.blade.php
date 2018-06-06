@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="table-responsive">
                <table class="table color-table success-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dssp as $sp)
                        <tr>
                            <td><a href="{{ route('san-pham.show', ['id' => $sp->id]) }}" class="text-primary">{{ $sp->tensanpham }}</a></td>
                            <td>{{ number_format($sp->gia, 0, ',', '.') }}</td>
                            <td>{{ $sp->soluong }}</td>
                            <td><a href="{{ route('loai-san-pham.show', ['id' => $sp->LoaiSP->id]) }}">{{ $sp->LoaiSP->tenloai }}</a></td>
                            <td>{{ $sp->NhaCungCap->ten }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($sp->created_at)) }}</td>
                            <td>
                                <form id="form{{ $sp->id }}" action="{{ route('san-pham.destroy', ['id' =>$sp->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('san-pham.edit', ['id' => $sp->id]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="{{ route('san-pham.destroy', ['id' =>$sp->id]) }}" id='orm{{ $sp->id }}' class='deleteWarning' data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger m-r-10"></i> </a>
                                <a href="{{ route('san-pham.images', ['id' =>$sp->id]) }}" data-toggle="tooltip" data-original-title="Images"> <i class="fa fa-file-image-o text-success m-r-10"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $dssp->links() }}
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
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
                            <th>Loại sản phẩm</th>
                            <th>Ngày thêm</th>
                            <th>Ngày cập nhật</th>
                            <th>Hành động</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($loaisp as $v)
                        <tr>
                            <td>{{ $v->tenloai }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->updated_at)) }}</td>
                            <td>
                                <form id="form{{ $v->id }}" action="{{ route('loai-san-pham.destroy', ['id' =>$v->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('loai-san-pham.edit', ['id' => $v->id]) }}" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="{{ route('loai-san-pham.destroy', ['id' =>$v->id]) }}" id='orm{{ $v->id }}' class='deleteWarning' data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $loaisp->links() }}
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
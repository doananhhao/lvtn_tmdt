@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <select class="custom-select col-12" id="getList">
                @if (request()->has('tinhtrang'))
                <option value="2">Tất cả</option>
                <option value="0"{{ request()->get('tinhtrang') == 0 ? " selected" : "" }}>Chưa duyệt</option>
                <option value="1"{{ request()->get('tinhtrang') == 1 ? " selected" : "" }}>Đã duyệt</option>
                @else
                <option value="2" selected>Tất cả</option>
                <option value="0">Chưa duyệt</option>
                <option value="1">Đã duyệt</option>
                @endif
            </select>
        </div>
    </div>
</div>

<div class="row">
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
                            <th data-toggle="tooltip" data-original-title="Điểm tích lũy">Điểm</th>
                            <th>Ngày tạo</th>
                            <th>Ngày hết hạn</th>
                            <th class="text-center">Đã duyệt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dangban as $v)
                        <tr>
                            <td>{{ $v->ThanhVien->User->email }}</td>
                            <td>{{ $v->SanPham->tensanpham }}</td>
                            <td>{{ $v->ThanhVien->diemtichluy }}</td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}</td>
                            @if (strtotime($v->ngayhethan) > strtotime(date('Y-m-d H:i:s')))
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->ngayhethan)) }}</td>
                            @else
                            <td><span class="label label-danger">{{ date('d-m-Y H:i:s', strtotime($v->ngayhethan)) }}</span></td>
                            @endif
                            <td class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox"{{ $v->tinhtrang == 1 ? " checked" : "" }} value="{{ $v->id }}" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('dang-ban.edit', ['id' => $v->id]) }}" data-toggle="tooltip" data-original-title="Xem chi tiết và cập nhật"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $dangban->links() }}
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
    $('#getList').on('change', function(){
        if ($(this).val() != '2')
            window.location.href = "{{ route('dang-ban.index') }}?tinhtrang=" + $(this).val()
        else
            window.location.href = "{{ route('dang-ban.index') }}"
    })
    $(':checkbox').on('click', function(e){
        e.preventDefault()
        var input = $(this)
        var obj = {
				"id": $(this).val(),
                "tinhtrang": $(this).prop("checked") ? 1 : 0
			};
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        //tinhtrang: tình trạng SẼ SỬA ĐỔI
        $.ajax({
            url: '{{ route('tinhtrang') }}',
			type: "POST",
			dataType: "json",
			data: obj,
			success: function(data){
                if (data.success){
                    swal({
                        title: "Thay đổi tình trạng thành công",   
                        text: "Tình trạng: " + (data.checked == 1 ? "Đã duyệt" : "Chưa duyệt"),   
                        timer: 1000,
                        allowOutsideClick: true
                    })
                    input.prop("checked", data.checked)
                }else{
                    swal("Lỗi", "Đã có người khác thay đổi")
                }
			},
			error: function (data) {
				console.log('Error:', data);
			}
        })
    })
    </script>
@endsection
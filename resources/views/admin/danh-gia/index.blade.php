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
                        <option value="0"{{ request()->get('tinhtrang') == 0 ? " selected" : "" }}>Chưa duyệt</option>
                        <option value="1"{{ request()->get('tinhtrang') == 1 ? " selected" : "" }}>Đã duyệt</option>
                        @else
                        <option value="2" selected>Tất cả</option>
                        <option value="0">Chưa duyệt</option>
                        <option value="1">Đã duyệt</option>
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
                            <option value="{{ $sp->id }}"{{ request()->get('sanpham') == $sp->id ? " selected" : "" }}>{{ $sp->tensanpham }}</option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                {{-- <div class="panel-footer"> Panel Footer </div> --}}
            </div>
        </div>
    </div>

    @if ($dg->isEmpty())
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
                            <th>Số sao</th>
                            <th>Ngày đánh giá</th>
                            <th class="text-center">Đã duyệt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dg as $v)
                        <tr>
                            <td>{{ $v->ThanhVien->User->email }}</td>
                            <td><a href="{{ route('chitietsanpham', ['tensp' => $v->SanPham->id]) }}" target="_blank">{{ $v->SanPham->tensanpham }}</td>
                            <td>
                                <div class="rateit" data-rateit-value="{{ $v->votes / 2 }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                            </td>
                            <td>{{ date('d-m-Y H:i:s', strtotime($v->created_at)) }}</td>
                            <td class="text-center">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox"{{ $v->tinhtrang == 1 ? " checked" : "" }} value="{{ $v->thanhvien_id.'-'.$v->sanpham_id }}" class="custom-control-input">
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('danh-gia.show', ['id_tv' => $v->thanhvien_id, 'id_sp' => $v->sanpham_id]) }}" target="_blank" data-toggle="tooltip" data-original-title="Xem đánh giá"> <i class="fa fa-eye text-inverse m-l-10"></i> </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pull-right">
                    {{ $dg->links() }}
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

    <!-- Rateit -->
    <link rel="stylesheet" href="{{ asset('') }}shop/css/rateit.css">
    <script src="{{ asset('') }}shop/js/jquery.rateit.min.js"></script>

    <!-- Select -->

    {{-- <link href="{{ asset('plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" /> --}}
    {{-- <link href="{{ asset('plugins/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" /> --}}
    <link href="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
    {{-- <link href="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet') }}" type="text/css" /> --}}
    {{-- <script src="{{ asset('plugins/bower_components/switchery/dist/switchery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('plugins/bower_components/multiselect/js/jquery.multi-select.js') }}"></script> --}}


    <script>
    $('.selectpicker').selectpicker();
    $('select').on('change', function(){
        var getList = $('#getList')
        var getListSP = $('#getListSP')

        if (getList.val() == '2'){
            if (getListSP.val() == 0)
                window.location.href = "{{ route('danh-gia.index') }}"
            else{
                window.location.href = "{{ route('danh-gia.index') }}?sanpham=" + getListSP.val()
            }
        }else{
            if (getListSP.val() == 0)
                window.location.href = "{{ route('danh-gia.index') }}?tinhtrang=" + getList.val()
            else{
                window.location.href = "{{ route('danh-gia.index') }}?tinhtrang=" + getList.val() + "&sanpham=" + getListSP.val()
            }
        }
    })
    $(':checkbox').on('click', function(e){
        e.preventDefault()
        var input = $(this)
        var arr = $(this).val().split('-')
        var obj = {
				"id_tv": arr[0],
				"id_sp": arr[1],
                "tinhtrang": $(this).prop("checked") ? 1 : 0
			};
        console.log(obj)
        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
        //tinhtrang: tình trạng SẼ SỬA ĐỔI
        $.ajax({
            url: "{{ route('danh-gia.tinhtrang') }}",
			type: "POST",
			dataType: "json",
			data: obj,
			success: function(data){
                if (data.success){
                    swal({
                        title: "Thay đổi trạng thái thành công",   
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
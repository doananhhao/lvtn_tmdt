@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <button class="fcbtn btn btn-success btn-outline btn-1f" data-toggle="tooltip" data-original-title="Quay lại" onclick="window.location.href='{{ url()->previous() }}'"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
            <h3 class="box-title"></h3>
            {{-- <p class="text-muted m-b-30">Use default tab with class <code>customtab</code></p> --}}
            <ul class="nav customtab nav-tabs" role="tablist">
                <li role="presentation" class="nav-item"><a href="#user" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> User</span></a></li>
                <li role="presentation" class="nav-item"><a href="#danhgia" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Đánh giá</span></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="user">
                    <div class="col-md-7 col-sm-12">
                        <p>Tên: <span class="p-l-20 text-primary">{{ $dg->ThanhVien->User->name }}</span></p>
                        <p>Email: <span class="p-l-20 text-primary">{{ $dg->ThanhVien->User->email }}</span></p>
                        <p>Giới tính: <span class="p-l-20 text-primary">{{ $dg->ThanhVien->User->nam==1 ? "Nam" : "Nữ" }}</span></p>
                        <p>ĐT: <span class="p-l-20 text-primary">{{ $dg->ThanhVien->User->sdt }}</span></p>
                        <p>Trạng thái: <span class='m-l-20 {{ $dg->ThanhVien->User->trangthai == 1 ? "label label-success" : "label label-danger" }}'>{{ $dg->ThanhVien->User->trangthai == 1 ? "Hoạt động" : "Bị khóa" }}</span></p>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <p>Điểm: <span class="text-warning">{{ $dg->ThanhVien->diemtichluy }}</span></p>
                        <p>Cấp độ: <span class="text-warning">{{ $dg->ThanhVien->CapDo != null ? $dg->ThanhVien->CapDo->capdo : "" }}</span></p>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="danhgia">
                    <div class="col-md-12">
                        <div class="m-b-20 text-primary"><b>Đã duyệt: </b>
                            <label class="m-l-10 custom-control custom-checkbox">
                                <input type="checkbox"{{ $dg->tinhtrang == 1 ? " checked" : "" }} value="{{ $dg->thanhvien_id.'-'.$dg->sanpham_id }}" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                            </label>
                        </div>
                        <h4>Tiêu đề: {{ $dg->tieude }}</h4>
                        <div class="rateit" data-rateit-value="{{ $dg->votes / 2 }}" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                        <div class="m-t-10 card card-outline-secondary text-center text-dark">
                            <div class="card-block">
                                {{ $dg->noidung }}
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_plugin')
    <!-- Rateit -->
    <link rel="stylesheet" href="{{ asset('') }}shop/css/rateit.css">
    <script src="{{ asset('') }}shop/js/jquery.rateit.min.js"></script>
    <!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

    <script>
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
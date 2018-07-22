@extends('admin.layouts.index')

@section('content')
@php
$styleuser = [
    1 => 'label label-rouded label-primary',
    2 => 'label label-rouded label-danger',
    3 => 'label label-rouded label-danger',
    4 => 'label label-rouded label-success',
];
@endphp
<div class="row">

    <div class="col-md-12">
        <div class="white-box">
            <!-- Tabstyle start -->
            {{-- <h3 class="box-title m-b-0">Tabstyle 1 </h3>
            <code>sttabs tabs-style-bar</code>
            <hr> --}}
            <section>
                <div class="sttabs tabs-style-bar">
                    <nav>
                        <ul>
                            <li><a href="#section-bar-1" class="sticon ti-id-badge"><span>Người mua</span></a></li>
                            <li><a href="#section-bar-2" class="sticon ti-notepad"><span>Hóa đơn</span></a></li>
                            <li><a href="#section-bar-3" class="sticon ti-reload"><span>Xử lý</span></a></li>
                        </ul>
                    </nav>
                    <div class="content-wrap">
                        <section id="section-bar-1">
                            {{-- <h3>Thông tin người mua</h3> --}}
                            <div class="text-primary" style="font-size: 20px">
                                {{-- <div>Họ tên: <span class="text-muted font-normal">Đoàn Anh Hào</span></div> --}}
                                <div>
                                    <div class="col-xs-4 col-md-2">Họ tên:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">{{ $hd->User->name }}</div>
                                </div>
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Email:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">{{ $hd->User->email }}</div>
                                </div>
                                <br>
                                <hr>
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Tài khoản:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">
                                        <span class="{{ $styleuser[$hd->User->LoaiUser->id] }}">{{ $hd->User->LoaiUser->tenloai }}</span>
                                    </div>
                                </div>
                                @if($hd->User->LoaiUser->id == 4)
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Cấp độ:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">
                                        {{ $hd->User->ThanhVien->CapDo->capdo }}
                                    </div>
                                </div>
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Điểm:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">
                                        {{ number_format($hd->User->ThanhVien->diemtichluy, 0, ',', '.') }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </section>

                        <section id="section-bar-2">
                            <h4>Thông tin chi tiết hóa đơn</h4>
                            <div style="font-size: 16px">
                                <div>
                                    <div class="col-xs-4 col-md-2 text-success">Tình trạng:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">
                                        @if ($hd->dahuy == 1)
                                        <span class="label label-danger">Đã hủy</span>
                                        @else
                                            @if ($hd->CongDoanHoaDon()->where([['congdoan_id', 3], ['status', 1]])->first() != null)
                                            <span class="label label-success">Hoàn thành</span>
                                            @else
                                            <span class="label label-info">Đang xử lý</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="col-xs-4 col-md-2">Địa chỉ:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">{{ $hd->diachi }}</div>
                                </div>
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Điện thoại:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">{{ $hd->sdt }}</div>
                                </div>
                                <div class="p-t-20">
                                    <div class="col-xs-4 col-md-2">Ghi chú thêm:</div>
                                    <div class="col-xs-8 col-md-10 text-muted">{{ $hd->mota == "" ? "[Không có]" : $hd->mota }}</div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <hr>
                            <div class="table-responsive">
                                <table class="table color-table inverse-table">
                                    <thead>
                                        <th></th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Khuyến mãi</th>
                                        <th class="text-right">Thành tiền (VNĐ)</th>
                                    </thead>
                                    <tbody>
                                        @foreach($hd->ChiTietHoaDon as $cthd)
                                        @php
                                        if (!isset($dem))
                                            $dem = 1;
                                        if (!isset($sum))
                                            $sum = 0;
                                        $dem++;
                                        if ($cthd->LoaiKhuyenMai != null){
                                            $giamgia = $cthd->LoaiKhuyenMai->ChiTietKhuyenMai()->where('sanpham_id', $cthd->sanpham_id)->first()->giamgia;
                                            $thanhtien = (1-$giamgia)*$cthd->gia*$cthd->soluong;
                                        }else
                                            $thanhtien = $cthd->gia*$cthd->soluong;
                                        $sum += $thanhtien;
                                        @endphp
                                        <tr>
                                            <td>{{ $dem - 1 }}</td>
                                            <td>
                                                <a href="{{ route('chitietsanpham', ['tensp' => $cthd->sanpham_id]) }}" class="text-muted">{{ $cthd->SanPham->tensanpham}}</a>
                                            </td>
                                            <td>{{ $cthd->soluong }}</td>
                                            <td>{{ number_format($cthd->gia, 0, ',', '.') }}</td>
                                            <td>
                                                @if(isset($giamgia))
                                                <span class="label label-success">{{ $giamgia*100 }}%</span>
                                                @else
                                                <span class="label label-danger">Không có</span>
                                                @endif
                                            </td>
                                            <td class="text-right">{{ number_format($thanhtien, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-center text-success font-bold" colspan="5">TỔNG HÓA ĐƠN</td>
                                            <td class="text-right">{{ number_format($sum, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>

                        <section id="section-bar-3">
                            {{-- <h2>Xử lý</h2> --}}
                            <div class="table-responsive">
                                <table class="table color-table inverse-table">
                                    <thead>
                                        <th></th>
                                        <th>Kiểm tra</th>
                                        <th>Đóng gói</th>
                                        <th>Vận chuyển</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nhân viên xử lý</td>
                                            @include('admin.cdhd.table_sp_khonghuy')
                                        </tr>
                                        <tr>
                                            <td>Trưởng phòng chịu trách nhiệm</td>
                                            @foreach ($congdoan as $cd)
                                            <td>
                                                @if ($hd->CongDoanHoaDon()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first() != null)
                                                <span class="text-primary">{{ $hd->CongDoanHoaDon()->where('congdoan_id', $cd->id)->orderBy('id', 'desc')->first()->TruongPhong->User->name }}</span>
                                                @else
                                                <span class="text-danger">Chưa đến</span>
                                                @endif
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                    <!-- /content -->
                </div>
                <!-- /tabs -->
            </section>
        </div>
    </div>

</div>

@endsection

@section('custom_plugin')

<!-- Custom Theme JavaScript -->
<script src="{{ asset('admin/js/cbpFWTabs.js')}}"></script>
<script type="text/javascript">
(function() {

    [].slice.call(document.querySelectorAll('.sttabs')).forEach(function(el) {
        new CBPFWTabs(el);
    });

})();
</script>

@endsection
@extends('admin.layouts.index')

@section('content')

<div class="row">

    @if ($dshd->isEmpty())
    <div class="col-md-6 offset-md-3 col-sm-12">
        <div class="white-box text-center">
            <div class="alert alert-success m-b-0">Chưa có hóa đơn trong danh sách</div>
        </div>
    </div>
    @else
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="table-responsive">

                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th data-toggle="tooltip" data-original-title="Số hiệu hóa đơn">#</th>
                            <th>Người mua</th>
                            <th>Sản phẩm</th>
                            <th>Ngày lập</th>
                            <th>Ngày hủy</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dshd as $hd)
                        <tr>
                            <td>#{{ $hd->id }}</td>
                            <td>{{ ucwords($hd->User->name) }}</td>
                            <td>
                                @foreach ($hd->ChiTietHoaDon as $cthd)
                                <a href="{{ route('chitietsanpham', ['tensp' => $cthd->sanpham_id]) }}" class="text-muted">{{ $cthd->SanPham->tensanpham}}</a>
                                <small class="p-l-10 text-primary"> x {{ $cthd->soluong }}</small>
                                <br>
                                @endforeach
                            </td>
                            <td>{{ date('d-m-Y', strtotime($hd->created_at)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($hd->updated_at)) }}</td>
                            <td>
                                {{-- cả 2 hoặc chỉ chưa hủy --}}
                                <a href="{{ route('hoa-don-admin.detail', ['id' => $hd->id]) }}" data-toggle="tooltip" data-original-title="Chi tiết">
                                    <i class="fa fa-eye text-inverse m-l-10"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pull-right">
                    {{ $dshd->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
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
                            <th>Kiểm tra</th>
                            <th>Đóng gói</th>
                            <th>Vận chuyển</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dshd as $hd)
                        <tr id="{{ $hd->id }}">
                            <td>#{{ $hd->id }}</td>
                            <td>{{ ucwords($hd->User->name) }}</td>
                            @include('admin.cdhd.table_sp_khonghuy')
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
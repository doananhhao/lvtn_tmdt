@extends('admin.layouts.index')

@section('content')

<div class="row">

    @if ($ds->isEmpty())
    <div class="col-md-6 offset-md-3 col-sm-12">
        <div class="white-box text-center">
            <div class="alert alert-success m-b-0">Chưa có hóa đơn xử lý thành công</div>
        </div>
    </div>
    @else
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title"></h3>
            <p class="text-muted"></p>
            <div class="table-responsive">
                
                @if(Auth::User()->NhanVien->ChucVu->ten == "Trưởng phòng")
                @include('admin.cdhd.pb')
                @elseif(Auth::User()->NhanVien->ChucVu->ten == "Nhân viên")
                @include('admin.cdhd.nv')
                @endif

                <div class="pull-right">
                    {{ $ds->links() }}
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
@extends('admin.layouts.index')

@section('content')

<div class="row">
    
    <div class="col-md-3 col-sm-12">
        <div class="row el-element-overlay">
            <div class="col-md-12 col-sm-12">
                <div class="el-card-item" style="padding-bottom: 0">
                    <div class="el-card-avatar el-overlay-1">
                        <img src="{{ asset('useravatar/noavatar.png') }}" />
                        <div class="el-overlay scrl-dwn">
                            <ul class="el-info">
                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="{{ asset('useravatar/noavatar.png') }}"><i class="icon-magnifier"></i></a></li>
                                {{-- <li><a class="btn default btn-outline" href="javascript:void(0);"><i class="icon-link"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-6 offset-md-3 col-sm-12 offset-sm-0"> --}}
    <div class="col-md-9 col-sm-12">
        <div class="panel panel-default">
            {{-- <div class="panel-heading text-center"></div> --}}
            <div class="panel-wrapper collapse in">
                <table class="table table-hover">
                    {{-- <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead> --}}
                    @php
                        $styleLoaiUser = [
                            1 => 'label label-rouded label-primary',
                            2 => 'label label-rouded label-warning',
                            3 => 'label label-rouded label-success',
                            4 => 'label label-rouded label-info',
                        ];
                        $styleCV = [
                            1 => 'text-primary',
                            2 => 'text-warning',
                        ];
                    @endphp
                    <col width="30%">
                    <col width="70%">
                    <tbody>
                        <tr>
                            <td class="text-danger bg-inverse">Loại tài khoản</td>
                            <td class="text-center"><span class="{{ $styleLoaiUser[$user->LoaiUser->id] }}">{{ $user->LoaiUser->tenloai }}</span></td>
                        </tr>
                        @if ($user->NhanVien != null)
                        <tr>
                            <td class="text-danger bg-inverse">Phòng ban</td>
                            <td class="text-center">{{ $user->NhanVien->PhongBan->ten }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Chức vụ</td>
                            <td class="text-center"><span class="{{ $styleCV[$user->NhanVien->ChucVu->id] }}">{{ $user->NhanVien->ChucVu->ten }}</span></td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-danger bg-inverse">Họ tên</td>
                            <td class="text-center">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Giới tính</td>
                            <td class="text-center">{{ $user->nam == 1 ? "Nam" : "Nữ" }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Email</td>
                            <td class="text-center">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Điện thoại</td>
                            @if ($user->sdt != "")
                            <td class="text-center">{{ $user->sdt }}</td>
                            @else
                            <td class="text-center text-danger">
                                <span>Chưa có</span>
                            </td>
                            @endif
                        </tr>
                        <tr>
                            <td class="text-danger bg-inverse">Địa chỉ</td>
                            @if ($user->diachi != "")
                            <td class="text-center">{{ $user->diachi }}</td>
                            @else
                            <td class="text-center text-danger">
                                <span>Chưa có</span>
                            </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_plugin')

    <!-- Popup CSS -->
    <link href="{{ asset('plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">
    <!-- Magnific popup JavaScript -->
    <script src="{{ asset('plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js') }}"></script>


@endsection
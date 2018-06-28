<table class="table table-striped table-hover">
    <thead>
        <tr class="font-bold">
            <th>Email</th>
            <th>Tên nhân viên</th>
            <th>Điện thoại</th>
            <th>Chức vụ</th>
            <th>Phòng ban</th>
            <th>Tài khoản</th>
            <th>Trạng thái</th>
            <th data-toggle="tooltip" data-original-title="Action">
                <i class="fa fa-wrench text-primary m-l-10"></i>
            </th>
        </tr>
    </thead>
    <tbody>
        @php
        $style = [
            2 => 'text-primary',
            3 => 'text-info',
            4 => 'text-success',
        ];
        
        $styleCV = [
            1 => 'label label-primary',
            2 => 'label label-success',
        ]
        @endphp
        @foreach($users as $nhanvien)
        <tr id="{{ $nhanvien->nhanvien_id }}">
            <td>{{ $nhanvien->User->email }}</td>
            <td>{{ $nhanvien->User->name }}</td>
            <td>{{ $nhanvien->User->sdt }}</td>
            <td>
                <span class="{{ $styleCV[$nhanvien->ChucVu->id] }}">{{ $nhanvien->ChucVu->ten }}</span>
            </td>
            <td>{{ $nhanvien->PhongBan->ten }}</td>
            <td>
                @if (array_key_exists($nhanvien->User->LoaiUser->id, $style))
                <span class="font-bold {{ $style[$nhanvien->User->LoaiUser->id] }}">{{ $nhanvien->User->LoaiUser->tenloai }}</span>
                @else
                <span class="font-bold text-mute">{{ $nhanvien->User->LoaiUser->tenloai }}</span>
                @endif
            </td>
            <td>
                @if ($nhanvien->User->trangthai == 1)
                <span class="status label label-success" data-toggle="tooltip" data-original-title="Chọn để đổi trạng thái">Hoạt động</span>
                @else
                <span class="status label label-warning" data-toggle="tooltip" data-original-title="Chọn để đổi trạng thái">Tạm khóa</span>
                @endif
            </td>
            <td>
                <a data-toggle="tooltip" class='thaydoi_nv pointer' data-original-title="Thay đổi phòng ban, chức vụ"> 
                    <i class="fa fa-cog text-inverse m-l-10"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div id="ajax-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:200px">
            <div class="modal-header">
                <h4 class="modal-title" id='modal-title-id'>Nhân viên <span class="m-l-10 label label-rouded label-success"></span></h4>
                <h4 class="modal-title" id='modal-nv-email'>Email <span class="m-l-10 label label-rouded label-primary"></span></h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="getListNV" class="control-label">Phòng ban:</label>
                        <select class="selectpicker" data-style="form-control" id="getListPB">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="getListNV" class="control-label">Chức vụ:</label>
                        <select class="selectpicker" data-style="form-control" id="getListCV">
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger waves-effect waves-light" id="savechanges">Thực hiện</button>
            </div>
        </div>
    </div>
</div>
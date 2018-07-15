<table class="table color-table success-table">
    <thead>
        <tr>
            <th data-toggle="tooltip" data-original-title="Số hiệu hóa đơn">#</th>
            <th>Email người mua</th>
            <th>Sản phẩm</th>
            <th>Tổng giá</th>
            <th>Thực hiện</th>
            <th data-toggle="tooltip" data-original-title="Ngày hoàn thành công đoạn">CĐ hoàn thành</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ds as $cdhd)
        <tr>
            <td class="text-danger">#{{ $cdhd->HoaDon->id }}</td>
            <td>{{ $cdhd->HoaDon->User->email }}</td>
            <td>
                @foreach ($cdhd->HoaDon->ChiTietHoaDon as $cthd)
                <a href="{{ route('chitietsanpham', ['tensp' => $cthd->sanpham_id]) }}" class="text-muted">{{ $cthd->SanPham->tensanpham}}</a>
                <small class="p-l-10 text-primary"> x {{ $cthd->soluong }}</small>
                <br>
                @endforeach
            </td>
            <td>
                @php
                $total = 0;
                foreach ($cdhd->HoaDon->ChiTietHoaDon as $cthd){
                    if ($cthd->LoaiKhuyenMai != null){
                        $ctkm = $cthd->LoaiKhuyenMai->ChiTietKhuyenMai()->where('sanpham_id', $cthd->sanpham_id)->first();
                        $total += (1-$ctkm->giamgia) * $cthd->soluong * $cthd->gia;
                    }else{
                        $total += $cthd->soluong * $cthd->gia;
                    }
                }
                echo number_format($total, 0, ',', '.').' VNĐ';
                @endphp
            </td>
            <td>
                @php
                    $last_pc = $cdhd->HoaDon->PhanCong()->where('congdoan_id', $cdhd->congdoan_id)->orderBy('id', 'desc')->first();
                @endphp
                {{ $last_pc->NhanVien->User->name }}
            </td>
            <td>{{ date('d-m-Y', strtotime($last_pc->updated_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
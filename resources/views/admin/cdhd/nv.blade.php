<table class="table color-table success-table">
    <thead>
        <tr>
            <th>Ngày hoàn thành</th>
            <th>Hóa đơn #</th>
            <th>Công đoạn</th>
            <th>Sản phẩm</th>
        </tr>
    </thead>

    @php
    $style_cd = [
        'text-primary',
        'text-info',
        'text-success'
    ];
    @endphp

    <tbody>
        @foreach($ds as $pc)
        <tr>
            <td>{{ date('d-m-Y', strtotime($pc->updated_at)) }}</td>
            <td>{{ '#'.$pc->HoaDon->id }}</td>
            <td>
                @if(isset($style_cd[$pc->congdoan_id]))
                <span class="{{ $style_cd[$pc->congdoan_id] }}">{{ $pc->CongDoan->mota }}</span>
                @else
                <span class="text-warning">{{ $pc->CongDoan->mota }}</span>
                @endif
            </td>
            <td>
                @foreach ($pc->HoaDon->ChiTietHoaDon as $cthd)
                {{ $cthd->SanPham->tensanpham}}<small class="p-l-10 text-primary"> x {{ $cthd->soluong }}</small>
                <br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
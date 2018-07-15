<table class="table color-table success-table">
    <thead>
        <tr>
            <th>Ngày hoàn thành</th>
            <th>Hóa đơn #</th>
            <th>Công đoạn</th>
            <th>Sản phẩm</th>
            <th>Đánh giá CV</th>
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
                <a href="{{ route('chitietsanpham', ['tensp' => $cthd->sanpham_id]) }}" class="text-muted">{{ $cthd->SanPham->tensanpham}}</a>
                <small class="p-l-10 text-primary"> x {{ $cthd->soluong }}</small>
                <br>
                @endforeach
            </td>
            <td>
                @if ($pc->HoaDon->PhanCong()->where('congdoan_id', $pc->congdoan_id)->orderBy('id', 'desc')->first()->id == $pc->id)
                <span class="label label-rouded label-success">Hoàn thành</span>
                @else
                <span class="label label-rouded label-warning">Chưa hợp lệ</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
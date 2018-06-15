@extends('shop.layouts.page.info')




@section('content')




<div class="row">
        
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Đơn hàng đã hủy</h3>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                    <th >Mã Đơn hàng</th>
                                    <th>Ngày mua</th>
                                    <th>Địa chỉ</th>
                                    <th>Sđt</th>
                                    <th>Mô tả</th>
                                    <th>Tổng tiền</th>
                                    
                                    <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            @if ($order['huy'] == 1)
                            <tr>
                                <td><a href="{{ route('cancel-order-detail', ['id' => $order['id']]) }}">{{ $order['id'] }}</a></td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> {{ date('d-m-Y ', strtotime($order['created_at'])) }}</span> </td>
                                <td>{{ $order['diachi'] }}</td>
                                <td>{{ $order['sdt'] }}</td>
                                <td>{{ $order['mota'] }}</td>
                                
                                <td>$45.00</td>
                                <td><div class="label label-table label-danger">Đã hủy</div></td>
                            @endif   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('shop.layouts.page.info')




@section('content')




<div class="row">
        
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Quản lý đơn hàng </h3>
                <br>
                <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md" >
                                <select class="js-select2" name="order_status" id="status"  onchange="window.location.href = '{{ route('order_list') }}' + '/status/' + this.value">
                                    <option value="all" {{ (isset($status) && $status == 'all')?'selected':'' }}>Tất cả</option>
                                    <option value="complete" {{ (isset($status) && $status == 'complete')?'selected':'' }}>Đã mua</option>
                                    <option value="ongoing" {{ (isset($status) && $status == 'ongoing')?'selected':'' }}>Đang mua</option>
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            
                            
                        </div>
                        
                    </div>
                    <br>
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
                            @if ($order['dahuy'] == 0)
                            <tr>
                                <td><a href="{{ route('order-detail', ['id' => $order['id']]) }}">{{ $order['id'] }}</a></td>
                                <td><span class="text-muted"><i class="fa fa-clock-o"></i> {{ date('d-m-Y ', strtotime($order['created_at'])) }}</span> </td>
                                <td>{{ $order['diachi'] }}</td>
                                <td>{{ $order['sdt'] }}</td>
                                <td>{{ $order['mota'] }}</td>
                                
                                <td>$45.00</td>
                                <td>
                                       
                                        @if ($order['congdoan_id'] == 3 && $order['status'] == 1)
                                        <div class="label label-table label-success">Hoàn thành</div>
                                        
                                        @else
                                        <div class="label label-table label-danger">Đang tiến hành</div>
                                        @endif
                                </td>
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

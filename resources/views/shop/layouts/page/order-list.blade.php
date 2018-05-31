@extends('shop.layouts.page.info')




@section('content')




<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
    <!-- DATA TABLE -->
    <h3 class="title-5 m-b-35">Đơn Hàng Của Tôi</h3>
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
    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2" style="table-layout:fixed;">
            <thead >
                <tr>
                    <th >Mã Đơn hàng</th>
                    <th>Sđt</th>
                    <th>Mô tả</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt</th>
                    <th>Tình trạng</th>
                    
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody >
                

<tr class="spacer"></tr>
@foreach($orders as $order)
                
                <tr class="tr-shadow">
                    <td >{{ $order['id'] }}</td>
                    <td>{{ $order['sdt'] }}</td>
                    <td>{{ $order['mota'] }}
                    </td>
                    <td >{{ $order['diachi'] }}</td>
                    <td>{{ $order['created_at'] }}</td>
                    <td>@if ($order['tinhtrang'] == 0)
                        <span class="status--denied">Chưa hoàn thành</span>
                        @else
                            <span class="status--process">{{ $order['updated_at'] }}</span>
                        @endif
                    </td>
                    
                    <td>
                        <div class="table-data-feature">
                            
                            <a class="item" data-toggle="tooltip" data-placement="top" title="Xem chi tiết" href="{{ route('order-detail', ['id' => $order['id']]) }}">
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                            <button class="item" data-toggle="tooltip" data-placement="top" title="Hủy đơn hàng">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                            
                        </div>
                    </td>
                </tr>
@endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE -->
</div>
</div>
<div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
</div>
</div>
</div>
<div class="clearfix"></div>

@endsection

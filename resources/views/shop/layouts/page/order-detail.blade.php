@extends('shop.layouts.page.info')




@section('content')




<div class="main-content">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                               
                                                <th>Tên sản phẩm</th>
                                                <th class="text-right">Số lượng</th>
                                                <th class="text-right">Giá</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orders_detail as $value)
                                            <tr>
                                                <td>{{ $value['id'] }}</td>
                                                
                                                <td>{{ $value['tensanpham'] }}</td>
                                                <td class="text-right">{{ $value['soluong'] }}</td>
                                                <td class="text-right">{{ number_format($value['soluong']*$value['gia'], 2, '.', ' ') }}</td>
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
@extends('shop.layouts.page.info')




@section('content')




<div class="row">
        
        <div class="col-lg-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Danh sách Sản phẩm Đăng bán của bạn</h3>
                <br>
                <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="rs-select2--light rs-select2--md" >
                                
                                <select class="js-select2" name="dangban_status" id="status"  onchange="window.location.href = '{{ route('sell_list') }}' + '/status/' + this.value">
                                    <option value="all" {{ (isset($status) && $status == 'all')?'selected':'' }}>Tất cả</option>
                                    <option value="complete" {{ (isset($status) && $status == 'complete')?'selected':'' }}>Đã được duyệt</option>
                                    <option value="ongoing" {{ (isset($status) && $status == 'ongoing')?'selected':'' }}>Chưa được duyệt</option>
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
                                    <th>#</th>
                                    <th>Loại sản phẩm</th>
                                    <th>Sản phẩm</th>
                                    <th>Số lượng</th>
                                    
                                    {{--  <th>Mô tả</th>  --}}
                                    <th>Đơn giá</th>
                                    
                                    <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dangban as $db)
                            
                            <tr>
                                <td>{{ $db['id'] }}</td>
                                <td>{{ $db['tenloai'] }}</td>
                                {{--  <td><a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" >{{ $db['tensanpham'] }}</a></td>  --}}
                                <td>
                                    @if($db['ngungban']==0)
                                        @if ($db['canduyet'] == 1)
                                        <a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" >{{ $db['tensanpham'] }}</a>
                                            
                                        @elseif ($db['canduyet'] == 0)
                                            @foreach($statusdb as $sttdb)
                                                @if($db['id'] == $sttdb['dangban_id'])
                                                    @if($sttdb['status']==1)
                                                    <a href="{{route('chitietsanphamdaily',$db['sanpham_id'])}}" data-toggle="tooltip" >{{ $db['tensanpham'] }}</a>
                                                        @break
                                                    @else
                                                    <a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" >{{ $db['tensanpham'] }}</a>
                                                        @break
                                                    @endif
                                                
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                    <a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" >{{ $db['tensanpham'] }}</a>
                                    @endif
                                </td>
                                <td>{{ $db['soluong'] }}</td>
                                {{--  <td>{{ $db['mota'] }}</td>  --}}
                                <td>{{ $db['gia'] }}</td>
                                
                                <td>
                                    @if($db['ngungban']==0)
                                        @if ($db['canduyet'] == 1)
                                            <div class="label label-table label-info"><a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" style="color: white">Đang chờ duyệt</a></div>
                                            
                                        @elseif ($db['canduyet'] == 0)
                                            @foreach($statusdb as $sttdb)
                                                @if($db['id'] == $sttdb['dangban_id'])
                                                    @if($sttdb['status']==1)
                                                        <div class="label label-table label-success"><a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" style="color: white">Đã đăng bán</a></div>
                                                        @break
                                                    @else
                                                        <div class="label label-table label-warning"><a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" style="color: white">Cập nhật lại</a></div>
                                                        @break
                                                    @endif
                                                
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        <div class="label label-table label-danger"><a href="{{ route('sell-show', ['id' => $db['sanpham_id']]) }}" data-toggle="tooltip" style="color: white">Đã ngưng bán</a></div>
                                    @endif
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

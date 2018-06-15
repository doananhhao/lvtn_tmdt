@extends('shop.layouts.page.info')



@section('content')




<div class="col-sm-12">
        <div class="white-box">
            @foreach($thanhvien as $value)       
                <h3>Điểm tích lũy</h3>
                <p>Giá trị hóa đơn đã hoàn thành sẽ được chuyển thành điểm tích lũy</p>
                <div class="progress">
                
                @foreach($capdo as $lv) 
                @if ($value['diemtichluy'] <= $lv['point'])
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo floor(($value['diemtichluy']-$diemhientai)/($lv['point']-$diemhientai)*100);?>%">
                    <span id="current-progress"></span>
                  </div>
                  @break
                @endif
                @if ($value['diemtichluy'] > $lv['point'])
                    
                    @continue($diemhientai=$lv['point'])
                @endif  
              @endforeach   
                </div>
                <div style="width: 50%;margin: 10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">Cấp độ hiện tại ({{$value['capdo']}}) </div>
                            <div class="panel-wrapper collapse in">
                                <table class="table table-hover" >
                                    <thead>
                                        <tr >
                                            
                                            <th style="text-align: center">Điểm hiện tại</th>
                                            <th style="text-align: center">Điểm cấp tiếp theo</th>
                                            <th style="text-align: center">Điểm còn thiếu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td>{{ number_format($value['diemtichluy'], 0, ' ', ' ') }}</td>
                                            <td>
                                                @foreach($capdo as $lv) 
                                                    @if ($value['diemtichluy'] <= $lv['point'])
                                                        {{$lv['point']}}
                                                        @break
                                                    @endif
                                                    @if ($value['diemtichluy'] > $lv['point'])
                                                        @continue
                                                    @endif  
                                                @endforeach   
                                            </td>
                                            <td>
                                                @foreach($capdo as $lv) 
                                                    @if ($value['diemtichluy'] <= $lv['point'])
                                                        {{ number_format($lv['point']-$value['diemtichluy'], 0, ' ', ' ') }}
                                                        @break
                                                    @endif
                                                    @if ($value['diemtichluy'] > $lv['point'])
                                                        @continue
                                                    @endif  
                                                @endforeach   
                                            </td>
                                        </tr>
                                        @if ($value['capdo'] < 4)
                                        <tr style="text-align: center">
                                            <td colspan="3">Đạt cấp 4 để trở thành đại lý bán hàng</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if ($value['capdo'] >= 4)
                <button style="margin: 10px;" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Làm đại lý</button>
                    @endif
            @endforeach 
        </div>
    </div>

@endsection

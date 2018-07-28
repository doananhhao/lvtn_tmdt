@extends('shop.layouts.page.info')



@section('content')




<div class="col-sm-12">
        <div class="white-box">
            @foreach($thanhvien as $value)       
                <h3>Điểm tích lũy</h3>
                <p>Giá trị hóa đơn đã hoàn thành sẽ được chuyển thành điểm tích lũy.
                    (<a href="{{ route('csbh') }}#capdo">Chi tiết</a>)
                </p>
                <div class="progress">
            @if($value['id'] != 2)    
                @foreach($capdo as $lv) 
                @if ($value['diemtichluy'] == 0)
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span id="current-progress"></span>
                  </div>
                  @break
                @elseif ($value['diemtichluy'] == $lv['diem'])
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span id="current-progress"></span>
                  </div>
                  @break
                @elseif ($value['diemtichluy'] < $lv['diem'])
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo floor(($value['diemtichluy']-$diemhientai)/($lv['diem']-$diemhientai)*100);?>%">
                    <span id="current-progress"></span>
                  </div>
                  @break
                  @elseif ($value['diemtichluy'] >= 40000000)
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    <span id="current-progress"></span>
                  </div>
                  @break
                @elseif ($value['diemtichluy'] > $lv['diem'])
                    
                    @continue($diemhientai=$lv['diem'])
                @endif 
                @endforeach 
            @else
                @foreach($capdo as $lv) 
                        @if($value['diemtichluy'] == 5000000)
                                <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                <span id="current-progress"></span>
                                </div>
                                @break
                        

                        @elseif (($value['diemtichluy'] > $lv['diem'])  && ($lv['diem'] < 15000000))
                            @continue($diemhientai=$lv['diem'])
                            

                        
                        @else
                            
                            @if(($value['diemtichluy'] < $lv['diem']))
                                <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo floor(($value['diemtichluy']-$diemhientai)/($lv['diem']-$diemhientai)*100);?>%">
                                <span id="current-progress"></span>
                                </div>
                                @break
                            

                            @else
                                <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span id="current-progress"></span>
                                </div>
                                @break
                            @endif 
                        @endif 

                @endforeach  
            @endif
             
                </div>
                <div style="width: 50%;margin: 10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">Cấp độ hiện tại ({{$value['capdo']}}) </div>
                            <div class="panel-wrapper collapse in">
                                @if($value['id'] == 4) 
                                <table class="table table-hover" >
                                        <thead>
                                            <tr >
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <tr style="text-align: center">
                                                <td colspan="3">Bạn đã đặt cấp độ tối đa.</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                @else
                                <table class="table table-hover" >
                                    <thead>
                                        <tr >
                                            
                                            <th style="text-align: center">Điểm hiện tại</th>
                                            <th style="text-align: center">Điểm lên cấp tiếp theo</th>
                                            <th style="text-align: center">Điểm còn thiếu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="text-align: center">
                                            <td>{{ number_format($value['diemtichluy'], 0, ' ', ' ') }}</td>
                                            <td>
                                                @if($value['id'] != 2)  
                                                    @foreach($capdo as $lv) 
                                                        @if ($value['diemtichluy'] == $lv['diem'])
                                                            @continue
                                                        @elseif ($value['diemtichluy'] > $lv['diem'])
                                                            @continue
                                                       
                                                        @else
                                                            {{number_format($lv['diem'], 0, ' ', ' ')}}
                                                            @break
                                                        @endif  
                                                    @endforeach
                                                @elseif($value['id'] == 2)
                                                    @foreach($capdo as $lv) 
                                                        @if ($value['diemtichluy'] == $lv['diem'])
                                                            @continue
                                                        @elseif ($value['diemtichluy'] > $lv['diem'])
                                                            @continue
                                                        
                                                        @else
                                                            {{number_format($lv['diem'], 0, ' ', ' ')}}
                                                            @break
                                                        @endif  
                                                    @endforeach
                                                @endif 
                                            </td>
                                            <td>
                                                @if($value['id'] != 2)
                                                    @foreach($capdo as $lv) 
                                                        @if ($value['diemtichluy'] == $lv['diem'])
                                                            @continue
                                                        @elseif ($value['diemtichluy'] > $lv['diem'])
                                                            @continue
                                                        
                                                        @else
                                                            {{ number_format($lv['diem']-$value['diemtichluy'], 0, ' ', ' ') }}
                                                            @break
                                                        @endif  
                                                    @endforeach
                                                @elseif($value['id'] == 2)
                                                    @foreach($capdo as $lv) 
                                                        @if ($value['diemtichluy'] == $lv['diem'])
                                                            @continue
                                                        @elseif ($value['diemtichluy'] > $lv['diem'])
                                                            @continue
                                                        @else
                                                            {{ number_format($lv['diem']-$value['diemtichluy'], 0, ' ', ' ') }}
                                                            @break
                                                        @endif  
                                                    @endforeach
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @if ($value['id'] < 2)
                                        <tr style="text-align: center">
                                            <td colspan="3">Đạt cấp 2 có thể bán hàng</td>
                                        </tr>
                                        @endif
                                        @if ($value['id'] < 3)
                                        <tr style="text-align: center">
                                            <td colspan="3">Thăng cấp từ cấp 2 để trở thành đại lý bán hàng</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                        @if (($value['id'] == 2) && ($value['diemtichluy'] >= 15000000))
                            @if($daily==null)
                        <form action="{{ route('create-daily', ['id' => $value['user_id']]) }}" method="POST" class="form-horizontal">
                                @csrf
                            <button style="margin: 10px;" class="btn btn-success waves-effect waves-light" type="submit"><span class="btn-label"><i class="fa fa-check"></i></span>Làm đại lý</button>
                        </form>
                            @endif
                        @endif
            @endforeach 
        </div>
    </div>

@endsection

@section('custom_plugin')
    <!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <!-- Summernote -->
    <link href="{{ asset('plugins/bower_components/summernote-master/dist/summernote-bs4.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/summernote-master/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/summernote-master/lang/summernote-vi-VN.js') }}"></script>

    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 100,
            lang: 'vi-VN'
        });
    @if (session('success'))
        swal("Chúc mừng", "{{ session('success') }}", "success")
    @endif
    </script>

@endsection

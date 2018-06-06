@extends('shop.layouts.page.info')



@section('content')




<div class="col-sm-12">
        <div class="white-box">
                
                <h3>Điểm tích lũy</h3>
                <p>Giá trị hóa đơn đã hoàn thành sẽ được chuyển thành điểm tích lũy</p>
                <div class="progress">
                  <div id="dynamic" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                    <span id="current-progress"></span>
                  </div>
                  
                </div>
                <div style="width: 50%;margin: 10px;">
                        <div class="panel panel-default">
                            <div class="panel-heading">Cấp độ hiện tại (?) </div>
                            <div class="panel-wrapper collapse in">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>Điểm hiện tại</th>
                                            <th>Điểm cấp tiếp theo</th>
                                            <th>Điểm còn thiếu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2.000.000</td>
                                            <td>10.000.000</td>
                                            <td>8.000.000</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td colspan="3">Đạt cấp 4 để trở thành đại lý bán hàng</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <button style="margin: 10px;" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-check"></i></span>Làm đại lý</button>
                
        </div>
    </div>

@endsection
@section('custom_plugin')
<script>
        $(function() {
            var current_progress = 0;
            var interval = setInterval(function() {
                current_progress += 10;
                $("#dynamic")
                .css("width", current_progress + "%")
                .attr("aria-valuenow", current_progress)
                .text(current_progress + "% Complete");
                if (current_progress >= 100)
                    clearInterval(interval);
            }, 1000);
          });
    </script>
@endsection
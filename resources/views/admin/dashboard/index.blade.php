@extends('admin.layouts.index')

@section('content')

<div class="row">
    <div class="col-md-12 col-lg-3">
        <div class="white-box">
            <h3 class="box-title font-bold">Số hóa đơn</h3>
            <ul class="basic-list">
                <li>TỔNG SỐ <span class="pull-right text-primary p-r-10">{{ $hd->count() }}</span></li>
                <li class="text-danger">Đã hủy <span class="pull-right label-danger label">{{ $hd_dahuy->count() }}</span></li>
                <li>Đã hoàn thành <span class="pull-right label-success label">{{ $hd_dahoanthanh }}</span></li>
                <li>Đang kiểm tra <span class="pull-right label-info label">{{ $hd_dangkiemtra }}</span></li>
                <li>Đang đóng gói<span class="pull-right label-purple label">{{ $hd_dangdonggoi }}</span></li>
                <li>Đang vận chuyển<span class="pull-right label-warning label">{{ $hd_dangvanchuyen }}</span></li>
            </ul>
        </div>
    </div>

    <div class="col-md-12 col-lg-3">
        <div class="white-box">
            <h3 class="box-title font-bold">Tài khoản</h3>
            <ul class="basic-list">
                @php
                    $styleTK = [
                        1 => 'label-purple label',
                        2 => 'label-warning label',
                        3 => 'label-success label',
                        4 => 'label-info label'
                    ];
                @endphp
                <li>TỔNG SỐ <span class="pull-right text-primary p-r-10">{{ $user->count() }}</span></li>
                <li class="text-danger">Bị khóa <span class="pull-right label-danger label">{{ $user_khoa->count() }}</span></li>
                @foreach($loaiuser as $loai)
                <li>{{ $loai->tenloai }} <span class="pull-right {{ $styleTK[$loai->id] }}">{{ $loai->User->count() }}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="white-box">
            <h3 class="box-title font-bold">Sản phẩm</h3>
            <div>
                <canvas id="myChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_plugin')

    <script src="{{ asset('plugins/bower_components/chartjs/Chart.min.js') }}"></script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');

        $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

        $.ajax({
            url: '{{ route('dashboard.chart_sanpham') }}',
			type: "GET",
			dataType: "json",
            success: function(data){
                var obj = {}
                var data_chart = {}

                data_chart.labels = data.labels

                obj.data = data.dataSPC
                obj.backgroundColor = data.bgColor
                // obj.borderColor = data.bdColor
                obj.borderWidth = 2
                obj.label = 'Sản phẩm chính'

                obj2 = Object.assign({}, obj)
                // obj2.data = [2,5,2,1,4,3,5,8,2,1]
                obj2.data = data.dataSP_nguoidung
                obj2.label = 'Sản phẩm đăng bán'

                data_chart.datasets = [obj, obj2]
        
                var myPieChart = new Chart(ctx,{
                    type: 'pie',
                    data: data_chart,
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: data.title
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        },
                        tooltips: {
                            callbacks: {
                                label: function(item, data) {
                                    return data.datasets[item.datasetIndex].label+ " - "+ data.labels[item.index]+ ": "+ data.datasets[item.datasetIndex].data[item.index] + ' sản phẩm';
                                }
                            }
                        }
                    }
                });
            },
            error: function(data){
                console.log('error: Có lỗi xảy ra')
                console.log(data)
            }
        })

        // var data = {
        //     labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        //     datasets: [{
        //         label: '# of Votes',
        //         data: [12, 19, 3, 5, 2, 3],
        //         backgroundColor: [
        //             'rgba(255, 99, 132, 0.2)',
        //             'rgba(54, 162, 235, 0.2)',
        //             'rgba(255, 206, 86, 0.2)',
        //             'rgba(75, 192, 192, 0.2)',
        //             'rgba(153, 102, 255, 0.2)',
        //             'rgba(255, 159, 64, 0.2)'
        //         ],
        //         borderColor: [
        //             'rgba(255,99,132,1)',
        //             'rgba(54, 162, 235, 1)',
        //             'rgba(255, 206, 86, 1)',
        //             'rgba(75, 192, 192, 1)',
        //             'rgba(153, 102, 255, 1)',
        //             'rgba(255, 159, 64, 1)'
        //         ],
        //         borderWidth: 1
        //     }]
        // };
    </script>

@endsection
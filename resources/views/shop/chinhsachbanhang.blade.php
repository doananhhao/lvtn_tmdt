@extends('shop.layouts.index')

@section('main_content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Chính sách bán hàng</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd" style="font-size: 16px">
	<div class="container">
		<div class="terms-conditions-page inner-bottom-sm">

            <div class="row chinh-sach-content"> 
                <div class="col-md-12 terms-conditions">
                    <h2 class="page-title">Chính Sách Bán Hàng</h2>
                    <span class="sub-heading low">Quy định chung khi bán hàng trên sàn</span>
                    <ol class="inner-top-sm">
                        <li>Đảm bảo chất lượng hàng hoá, nguồn gốc xuất xứ và tuân theo quy định pháp luật</li>
                        <li>Cung cấp hoá đơn cho khách hàng khi có yêu cầu trong vòng 7 ngày kể từ khi giao hàng thành công</li>
                        <li>Chịu trách nhiệm bảo hành, đổi mới sản phẩm cho khách hàng khi có lỗi xảy ra. Tuân thủ theo chính sách xử lý hậu mãi đã quy định.</li>
                        <li>Giá bán trên là giá cuối cùng đã bao gồm nhưng không giới hạn các loại thuế.</li>
                        <li>Chịu trách nhiệm đăng kí các chương trình khuyến mãi với Bộ Công Thương</li>
                        <li>Bảo mật thông tin cá nhân của Khách hàng </li>
                    </ol>
                </div>
            </div>

            <div class="row" id="capdo">
                <div class="col-md-12 col-sm-12 terms-conditions">
                    <h2>Cấp độ và quyền lợi</h2>
                    <span>Để sử dụng cần phải đạt đến cấp độ đã yêu cầu</span>
                    <div class="table-responsive inner-top-sm">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <th class="text-center" style="vertical-align: middle;">#</th>
                                <th class="text-center" style="vertical-align: middle;">Cấp độ</th>
                                <th class="text-center" style="vertical-align: middle;">Điểm tích lũy <span>Giá của tổng hóa đơn</span></th>
                                {{-- <th class="text-center">Chiết khấu (Đại lý)</th> --}}
                                <th class="text-center" style="vertical-align: middle;">Đăng bán <span>Đăng bán sản phẩm cá nhân</span></th>
                                <th class="text-center" style="vertical-align: middle;">Đại lý <span>Quảng cáo sản phẩm chính của trang</span></th>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($capdo as $v)
                                @php
                                    if (!isset($i))
                                        $i = 0;
                                    $i++;
                                @endphp
                                <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $v->capdo }}</td>
                                <td>{{ number_format($v->diem, 0, ',', '.') }}</td>
                                {{-- @if ($v->chietkhau == 0)
                                <td style="color:red"><i class="fa fa-times" aria-hidden="true"></i></td>
                                @else
                                <td>{{ $v->chietkhau*100 }}%</td>
                                @endif --}}
                                @if ($v->id > 2)
                                <td><i style="color:green" class="fa fa-check" aria-hidden="true"></i></td>
                                <td><i style="color:green" class="fa fa-check" aria-hidden="true"></i> (Chiết khấu: {{ $v->chietkhau*100 }}%)</td>
                                @elseif ($v->id > 1)
                                <td style="color:green"><i class="fa fa-check" aria-hidden="true"></i></td>
                                <td style="color:red"><i class="fa fa-times" aria-hidden="true"></i></td>
                                @else
                                <td style="color:red"><i class="fa fa-times" aria-hidden="true"></i></td>
                                <td style="color:red"><i class="fa fa-times" aria-hidden="true"></i></td>
                                @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			{{-- <div class="row">
				<div class="col-md-12 terms-conditions">
                    <h2>Terms And Conditions</h2>
                    <span> This Agreement was last modified on July 20, 2014.</span>
                    <div class="inner-top-sm">
                        <h3>Intellectual Propertly</h3>
                        <ol>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. </li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        </ol>
                        <h3>Termination</h3>
                        <ol>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. </li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis diam erat. Duis velit lectus, posuere a blandit sit amet, tempor at lorem. Donec ultricies, lorem sed ultrices interdum. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        </ol>
                        <h3>Changes to this agreement</h3>
                        <p>We reserve the right, at our sole discretion, to modify or replace these Terms and Conditions by posting the updated terms on the Site. Your continued use of the Site after any such changes constitutes your acceptance of the new Terms and Conditions. </p>
                        <h3>Contact Us</h3>
                        <p>If you have any questions about this Agreement, please contact us filling this <a href="#" class='contact-form'>contact form</a></p>
                    </div>
                </div>
            </div><!-- /.row --> --}}
        </div><!-- /.sigin-in-->
    </div>
</div>

@endsection
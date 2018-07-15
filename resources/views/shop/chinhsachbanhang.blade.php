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

<div class="body-content outer-top-bd">
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
@extends('shop.layouts.index')

@section('main_content')

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="{{ route('home') }}">Home</a></li>
				<li class='active'>Thông tin</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="row inner-bottom-sm">
            <div class="contact-page">
                <div class="col-md-12 contact-map outer-bottom-vs">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d18646.689505761424!2d106.67249173224072!3d10.735747903937224!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x31e4d76059405939!2sSaigon+Technology+University!5e0!3m2!1sen!2s!4v1532233621350" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-md-9 contact-form">
                    <div class="col-md-12 contact-title">
                        <h3>Thông tin nhóm - ĐẠI HỌC CÔNG NGHỆ SÀI GÒN (STU)</h3>
                    </div>
                    <div class="col-md-6 info-stu">
                        <h4>Đoàn Anh Hào</h4>
                        <ul>
                            <li>Lớp: <span>D14-TH03</span></li>
                            <li>MSSV: <span>DH51400310</span></li>
                            <li>ĐT: <span>0938 863 567</span></li>
                            <li>Email: <span><a href="mailto:doananhhao01@gmail.com">doananhhao01@gmail.com</a></span></li>
                            <li>Khác: <span><a href="https://www.fb.com/DoanAnhHao209">fb.com/DoanAnhHao209</a></span></li>
                        </ul>
                    </div>
                    <div class="col-md-6 info-stu">
                        <h4>Huỳnh Phạm Minh Quân</h4>
                        <ul>
                            <li>Lớp: <span>D14-TH03</span></li>
                            <li>MSSV: <span>DH51401034</span></li>
                            <li>ĐT: <span>01644 020 967</span></li>
                            <li>Email: <span><a href="mailto:hpminhquan96@gmail.com">hpminhquan96@gmail.com</a></span></li>
                        </ul>
                    </div>       
                </div>
                
                <div class="col-md-9 info-stu">
                    <h4>File báo cáo và thông tin 
                        <a href="{{ asset('docs/LVTN-main.docx') }}">
                            <i class="fa fa-cloud-download" aria-hidden="true"></i>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@extends('shop.layouts.page.info')




@section('content')




<div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title" style="text-align: center">Thông tin sản phẩm của bạn</h3>
            
            <div class="table-responsive">
                <table class="table color-table info-table">
                    
                    <tbody>
                            
                            <tr>
                                <td style="width: 15%">Loại sản phẩm</td>
                                <td style="border-left: 1px solid #cdd0d4;">{{ $sanphamdb['loaisp_id'] }}</td>
                            </tr>
                            <tr>
                                <td>Sản phẩm</td>
                                <td style="border-left: 1px solid #cdd0d4;">{{ $sanphamdb['tensanpham'] }}</td>
                            </tr>
                            <tr>
                                <td>Số lượng</td>
                                <td style="border-left: 1px solid #cdd0d4;">{{ $sanphamdb['soluong'] }}</td>
                            </tr>
                            <tr>
                                <td>Ngày hết hạn</td>
                                <td style="border-left: 1px solid #cdd0d4;">{{date('d-m-Y',strtotime($dangban['ngayhethan']))}}</td>
                            </tr>
                            <tr>
                                <td>Mô tả</td>
                                <td style="border-left: 1px solid #cdd0d4;">{!!$sanphamdb['mota']!!}</td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid #cdd0d4;">Đơn giá</td>
                                <td style="border-left: 1px solid #cdd0d4;border-bottom: 1px solid #cdd0d4;">{{ $sanphamdb['gia'] }}</td>
                            </tr>
                            
                    </tbody>
                </table>
                @if($dangban['ngungban']==0)
                    @if($dangban['canduyet']==0)
                        @if($history['status'] == 1 )
                        <form action="{{ route('stop-sell',['id' => $dangban['id']]) }}" method="POST" class="form-horizontal">
                            @csrf
                            <button style="float: right" type="submit" class="btn btn-danger">Ngưng bán sản phẩm</button>
                        </form>
                        @endif
                    @endif
                @else
                <form action="{{ route('cont-sell',['id' => $dangban['id']]) }}" method="POST" class="form-horizontal">
                    @csrf
                    <button style="float: right" type="submit" class="btn btn-success">Tiếp tục bán sản phẩm</button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        @if($dangban['ngungban']==0)
            @if($dangban['canduyet']==0)
                @if($history['status'] == 0 )
                    <div class="panel panel-warning"  style="text-align: center">
                            <div class="panel-heading"> Cần cập nhật lại thông tin
                                <div class="pull-right"> </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <p>{{ $history['comment'] }}.<br><br> (Bấm vào <a href="{{ route('sell-edit',['id' => $sanphamdb['id']]) }}">đây</a> để điều chỉnh lại thông tin sản phẩm)</p>
                                </div>
                            </div>
                        </div>
   
                @else
                    <div class="panel panel-success"  style="text-align: center">
                            <div class="panel-heading"> Đã được chấp nhận
                                <div class="pull-right"> </div>
                            </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <p>Sản phẩm của bạn đã được chấp nhận.</p>
                                </div>
                            </div>
                        </div>
                @endif
            @else
                <div class="panel panel-info"  style="text-align: center">
                    <div class="panel-heading"> Chưa được duyệt
                        <div class="pull-right"> </div>
                    </div>
                    <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <p>Sản phẩm của bạn đang chờ được người kiểm duyệt tiếp nhận.</p>
                        </div>
                    </div>
                </div>   
            @endif
        @else
            <div class="panel panel-danger"  style="text-align: center">
                <div class="panel-heading"> Đã hủy bán sán phẩm
                    <div class="pull-right"> </div>
                </div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <p>Bạn đã hủy bán sản phẩm này.</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
            


  
@endsection

@section('javascript')
<!-- jQuery -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/tether.min.js') }}"></script>
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js') }}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--slimscroll JavaScript -->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<!-- Form Wizard JavaScript -->
<script src="{{ asset('plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js') }}"></script>
<!-- FormValidation -->
<link rel="stylesheet" href="{{ asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css') }}">
<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<script src="{{ asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('js/custom.min.js') }}"></script>
<!-- Sweet-Alert  -->
<script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
(function() {
    $('#exampleBasic').wizard({
        onFinish: function() {
            swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    });
    $('#exampleBasic2').wizard({
        onFinish: function() {
            swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    });
    $('#exampleValidator').wizard({
        onInit: function() {
            $('#validation').formValidation({
                framework: 'bootstrap',
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'The username is required'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'The username must be more than 6 and less than 30 characters long'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_\.]+$/,
                                message: 'The username can only consist of alphabetical, number, dot and underscore'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email address is required'
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            different: {
                                field: 'username',
                                message: 'The password cannot be the same as username'
                            }
                        }
                    }
                }
            });
        },
        validator: function() {
            var fv = $('#validation').data('formValidation');

            var $this = $(this);

            // Validate the container
            fv.validateContainer($this);

            var isValidStep = fv.isValidContainer($this);
            if (isValidStep === false || isValidStep === null) {
                return false;
            }

            return true;
        },
        onFinish: function() {
            $('#validation').submit();
            swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    });

    $('#accordion').wizard({
        step: '[data-toggle="collapse"]',

        buttonsAppendTo: '.panel-collapse',

        templates: {
            buttons: function() {
                var options = this.options;
                return '<div class="panel-footer"><ul class="pager">' +
                    '<li class="previous">' +
                    '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' +
                    '</li>' +
                    '<li class="next">' +
                    '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' +
                    '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' +
                    '</li>' +
                    '</ul></div>';
            }
        },

        onBeforeShow: function(step) {
            step.$pane.collapse('show');
        },

        onBeforeHide: function(step) {
            step.$pane.collapse('hide');
        },

        onFinish: function() {
            swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
        }
    });
})();
</script>
<!--Style Switcher -->
<script src="{{ asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection
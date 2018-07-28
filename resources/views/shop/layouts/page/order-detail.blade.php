@extends('shop.layouts.page.info')




@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">Tình trạng đơn hàng</h3>
            <div class="row line-steps">
              
                <div class="col-md-4 column-step start">
                    <div class="step-number">1</div>
                    <div class="step-title">Duyệt Đơn hàng</div>
                    <div class="step-info">Đơn hàng của bạn đã được tiếp nhận</div>
                </div>
                <div class="col-md-4 column-step <?php echo ($order['congdoan_id'] >= 2) ? "active" : ""; ?>">
                    <div class="step-number">2</div>
                    <div class="step-title">Đóng gói</div>
                    <div class="step-info">Đơn hàng của bạn đang được đóng gói</div>
                </div>
                <div class="col-md-4 column-step finish <?php echo ($order['congdoan_id'] == 3) ? "active" : ""; ?>">
                    <div style="<?php echo ($order['congdoan_id'] == 3) ? "color: #03a9f3;" : "" ?>"  class="step-number">3</div>
                    <div class="step-title">Vận chuyển</div>
                    <div class="step-info">Đơn hàng của bạn đã được chuyển đi</div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="row">
<div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title">Đơn hàng bao gồm</h3>
            <p class="text-muted">   <code></code></p>
            <div class="table-responsive">
                <table class="table color-table info-table">
                    <thead>
                        <tr>
                            
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($orders_detail as $value)
                            <tr>
                                
                                
                                <td>{{ $value['tensanpham'] }}</td>
                                <td >{{ $value['soluong'] }}</td>
                                <td >{{ number_format($value['soluong']*$value['gia'], 2, '.', ' ') }}</td>
                                
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
    <!-- Sweet-Alert  -->
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
    <script>
        @if (session('success'))
        swal("Chúc mừng", "{{ session('success') }}", "success")
        @endif
    </script>
@endsection
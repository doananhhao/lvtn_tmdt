<nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-user"></i>Quản lý tài khoản</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('acc-info') }}">Thông tin cá nhân</a>
                                </li>
                                <li>
                                    <a href="{{ route('change-pass') }}">Đổi mật khẩu</a>
                                </li>
                                <li>
                                    <a href="tab.html">Mã giảm giá</a>
                                </li>
                                
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-pencil-square-o"></i>Đơn hàng của tôi</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('order_list') }}">Danh sách đơn hàng</a>
                                </li>
                                <li>
                                    <a href="{{ route('cancel_order_list') }}">Đơn hàng hủy</a>
                                </li>
                                
                            </ul>
                        </li>
                        
                        
                    </ul>
                </nav>
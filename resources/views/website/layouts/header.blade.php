<!-- Navigation panel
    ================================================== -->
<nav class="main-nav transparent light stick-fixed">
    <div class="full-wrapper relative clearfix">

        <!-- Logo -->
        <div class="header-logo-wrap">
            <a href="{{ route('website.home') }}" class="logo">
                <img src="{{ asset('website_assets/images/logo2.png') }}" width="50" height="50" alt=""/>
            </a>
        </div>
        <!-- Logo -->
        <!-- Mobile nav bars -->
        <div class="mobile-nav">
            <i class="fa fa-bars"></i>
        </div>

        <!-- Main Menu -->
        <div class="nav-wrapper large-nav">
            <ul class="clearlist local-scroll">

                <!-- Multiple column menu example -->
                <li>
                    <a href="{{ route('website.home') }}"
                       class="border-menu after {{ request()->route()->getName() === 'website.home' ? 'active' : '' }}">Trang
                        chủ</a>
                </li>

                @if(auth(config('project.auth_guard.website'))->check())
                    <li class="nomargin">
                        <a href="{{ route('website.students.profile') }}"
                           class="border-menu after {{ request()->route()->getName() === 'website.students.profile' ? 'active' : '' }}"
                           title="Profile">Profile</a>
                    </li>
                    <li class="nomargin">
                        <a href="{{ route('website.students.logout') }}" class="border-menu after" title="Đăng xuất">
                            Đăng xuất
                        </a>
                    </li>
                @else
                    <li class="nomargin">
                        <a href="#" class="border-menu after" data-toggle="modal" data-target="#register_modal">Đăng
                            ký</a>
                    </li>
                    <li class="nomargin">
                        <a href="#" class="border-menu after" data-toggle="modal" data-target="#login_modal">Đăng
                            nhập</a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- End Main Menu -->

    </div>
</nav>
<!-- End Navigation panel -->

@if(!auth(config('project.auth_guard.website'))->check())
    <!-- Modal -->
    <div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="login_modal_title"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login_modal_title">Đăng nhập</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-subscribe">
                        <form class="account-form" id="login_form" data-redirect-url="{{ route('website.home') }}"
                              action="{{ route('website.students.login') }}"
                              method="POST">
                            <div class="form-group">
                                <div class="form-item">
                                    <input type="email" placeholder="Email" class="form-control" name="email">
                                </div>

                                <div class="form-item">
                                    <input type="password" placeholder="Mật khẩu" class="form-control"
                                           name="password">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-left">
                                            <a href="{{ route('website.students.forgot_password') }}"
                                               title="Quên mật khẩu"><h6>Quên mật khẩu?</h6></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-right">
                                            <button type="submit" class="btn bg-white" title="Đăng nhập">Đăng nhập
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="register_modal" tabindex="-1"
         role="dialog" aria-labelledby="register_modal_title"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register_modal_title">Đăng ký</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-subscribe">
                        <form class="account-form" data-redirect-url="{{ route('website.home') }}"
                              id="register_form" action="{{ route('website.students.register') }}"
                              method="POST">
                            <div class="form-group">
                                <div class="form-item">
                                    <input type="text" placeholder="Họ Tên" class="form-control" name="last_name">
                                </div>

                                <div class="form-item">
                                    <input type="email" placeholder="Email" class="form-control" name="email">
                                </div>

                                <div class="form-item">
                                    <input type="text" placeholder="Số điện thoại" class="form-control"
                                           name="phone_number">
                                </div>

                                <div class="form-item">
                                    <input type="password" placeholder="Mật khẩu" class="form-control"
                                           name="password">
                                </div>

                                <div class="form-item">
                                    <input type="password" placeholder="Nhập lại mật khẩu" class="form-control"
                                           name="password_confirmation">
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn bg-white" title="Đăng ký">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endif

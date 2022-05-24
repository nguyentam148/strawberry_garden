@extends('website.layouts.master')
@section('pageTitle', 'Profile')

@section('content')
    <!-- SECTION MY ACCOUNT
				================================================== -->
    <section id="my_account" class="page-section big-section">
        <div class="container relative">
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="col-sm-12 col-md-12 col-lg-12 mb-md-50 wow fadeIn">
                    <div class="account">
                        <div class="account-wrap">
                            <div class="account-image">
                                <div class="account-thumbnail"
                                     data-background="{{ asset('website_assets/images/logo2.png') }}"></div>
                            </div>
                            <div class="account-body text-left">
                                <h4 class="heading6 lp-0 mt-0 font-face1 text-left">{{ $student->getFullName() }}</h4>
                                <p>{{ $student->email }}</p>
                                <p>{{ $student->phone_number }}</p>
                                <a class="btn bg-white" style="width: 100%;" data-toggle="modal"
                                   data-target="#account_edit_modal">
                                    Sửa thông tin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Account edit Modal -->
                <div class="modal fade" id="account_edit_modal" tabindex="-1" role="dialog"
                     aria-labelledby="account_edit_modal_title" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="account_edit_modal_title">Sửa thông tin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-subscribe">
                                    <form class="account-form" id="account_edit_form"
                                          action="{{ route('website.students.profile.update') }}" method="POST">

                                        <div class="js_render_message"></div>

                                        <div class="form-group">
                                            <div class="form-item">
                                                <input type="text" placeholder="Họ Tên" class="form-control"
                                                       name="last_name" value="{{ $student->getFullName() }}">
                                            </div>

                                            <div class="form-item">
                                                <input type="text" placeholder="Số điện thoại" class="form-control"
                                                       name="phone_number" value="{{ $student->phone_number }}">
                                            </div>

                                            <div class="form-item">
                                                <h6>(*) Chỉ nhập khi muốn đổi mật khẩu.</h6>
                                                <input type="password" placeholder="Mật khẩu hiện tại"
                                                       class="form-control"
                                                       name="current_password">
                                            </div>

                                            <div class="form-item">
                                                <input type="password" placeholder="Mật khẩu mới" class="form-control"
                                                       name="password">
                                            </div>

                                            <div class="form-item">
                                                <input type="password" placeholder="Nhập lại mật khẩu mới"
                                                       class="form-control"
                                                       name="password_confirmation">
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn bg-white" title="Lưu">Lưu</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Account edit Modal -->
            </div>
            <div class="col-sm-12 col-md-8 col-lg-8">
                <h2 class="font-face1 section-heading fw800 mt-0 mb-60 mb-sm-40 text-center">Khóa học của tôi</h2>
                <div class="purchased-courses">
                    @if($myCourses->isNotEmpty())
                        @foreach($myCourses as $course)
                            @include('website.elements.course-item', ['course' => $course, 'isProfile' => true])
                        @endforeach
                    @else
                        <h6 class="text-center">Bạn chưa mua khoá học nào.</h6>
                    @endif
                </div>
            </div>
        </div>
    </section>
@stop

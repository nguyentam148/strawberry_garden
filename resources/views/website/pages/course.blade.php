@extends('website.layouts.master')
@section('pageTitle', 'Khoá học')

@section('content')
    <!-- SECTION ABOUT COURSE
        ================================================== -->
    <section id="about_course" class="page-section big-section">
        <div class="container relative about-course">
            <div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 mb-md-50 wow fadeIn course-info nopadding">
                <div class="shadow-title shadow-gray unselectable parallax-1">Khóa học</div>
                <h2 class="font-face1 section-heading fw800 mt-0 mb-60 mb-sm-40 text-center">{{ $course->name }}</h2>
                <div class="col-sm-12 col-md-12 col-lg-12 mb-md-50 wow fadeIn">
                    <div class="articles-course">
                        <div class="course-wrap">
                            <div class="course-body text-left">
                                <div class="description">
                                    <h4 class="heading6 lp-0 mt-0 font-face1 text-left">Thông tin buổi học</h4>
                                    {!! $course->description_1 !!}
                                </div>
                                <div class="list-lessons">
                                    <h4 class="heading6 lp-0 mt-0 font-face1 text-left">Danh sách bài học</h4>
                                    @foreach($course->lessons as $lesson)
                                        <p>{{ $lesson->name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 mb-md-50 wow fadeIn nopadding">
                <div class="articles-course">
                    <div class="course-wrap">
                        <div class="course-image relative">
                            <div class="article-thumbnail" data-background="{{ $course->getImageUrl() }}"></div>

                            @if(auth(config('project.auth_guard.website'))->check())
                                @if($course->student_status === \App\Models\CourseStudent::STATUS_ACCEPTED)
                                    <a class="btn bg-white buy-course-button"
                                       href="{{ route('website.course.learn', $course->slug) }}">
                                        Vào học
                                    </a>
                                @elseif($course->student_status === \App\Models\CourseStudent::STATUS_WAIT_ACCEPT)
                                    <a class="btn bg-white buy-course-button" disabled href="javascript:void(0);">
                                        Chờ xác nhận
                                    </a>
                                @else
                                    <a class="btn bg-white buy-course-button" id="js_register_course" href="#"
                                       data-toggle="modal"
                                       data-target="#buy_course_modal">
                                        Mua khóa học
                                    </a>
                                @endif
                            @else
                                <a href="#" class="btn bg-white buy-course-button" data-toggle="modal"
                                   data-target="#login_modal">Đăng nhập</a>
                            @endif

                            <div class="sessions light-text">
                                <span>{{ number_format($course->getCurrentPrice(), 0, ',', '.') }} VNĐ</span></div>
                        </div>
                        <div class="course-body text-left">
{{--                            <h4 class="heading6 lp-0 mt-0 font-face1 text-left">Giảng viên</h4>--}}
{{--                            <p class="bold-text">{{ $course->teacher_name }}</p>--}}
                            <p class="bold-text">Hotline:</p>
                            <p>096 987 2072 (Ms. Linh)</p>
                            <p class="bold-text">Email:</p>
                            <p>info.strawberryartgarden@gmail.com</p>
                            <p class="bold-text">Website:</p>
                            <p>vuonnghethuatdautay.vn</p>
                            <p class="bold-text">Fanpage:</p>
                            <p>fb.com/Vuon.nghe.thuat.Dau.tay</p>
                        </div>
                    </div>
                </div>

            @if(auth(config('project.auth_guard.website'))->check() && !in_array($course->student_status, [\App\Models\CourseStudent::STATUS_ACCEPTED, \App\Models\CourseStudent::STATUS_WAIT_ACCEPT]))
                <!-- Modal -->
                    <div class="modal fade" id="buy_course_modal" tabindex="-1" role="dialog"
                         aria-labelledby="buy_course_modal_title" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn hãy chuyển khoản tới số tài khoản 030 1000 337 097 ngân hàng Vietcombank chi nhánh Hoàn Kiếm, Hà Nội. Chủ khoản Phạm Quỳnh Anh.</p>
                                    <p>Số tiền: {{ number_format($course->getCurrentPrice(), 0, ',', '.') }} VNĐ</p>
                                    <p>Nội dung chuyển khoản: DANG KY KHOA HOC {{ $course->name }} SDT {{ auth()->user()->phone_number }}</p>
                                    <p>Sau khi chuyển khoản ấn nút đăng ký dưới đây</p>

                                    <a class="btn bg-white course-register-btn js_register_course"
                                       data-url="{{ route('website.students.buy_course', $course->getKey()) }}"
                                       href="javascript:void(0);">
                                        Đăng ký khóa học
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                @endif
            </div>
        </div>
    </section>
    <script src="{{ asset('admin_assets/plugins/jquery/jquery.min.js') }}"></script>
    <script>
        function getId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);

            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return 'error';
            }
        }
        $('oembed').each(function () {
            var videoId = getId($(this).attr('url'));

            var iframeMarkup = '<iframe style="width: 100%" height="400" src="//www.youtube.com/embed/'
                + videoId + '" frameborder="0" allowfullscreen></iframe>';
            $(this).html(iframeMarkup)
        })

    </script>
@stop

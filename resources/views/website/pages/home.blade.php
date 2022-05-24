@extends('website.layouts.master')
@section('pageTitle', 'Trang chủ')

@section('content')
    <!-- HOME SECTION
        ================================================== -->
    <section id="homepage" class="page-section">
        <div class="home-fullscreen-slider">
            <div class="item">
                <!-- Slide Item -->
                <section class="page-section fullscreen scroll overlay-dark-alpha-30"
                         data-background="{{ asset('website_assets/images/home/slider-1.jpg') }}">
                </section>
                <!-- End Slide Item -->
            </div>
            <div class="item">
                <!-- Slide Item -->
                <section class="page-section fullscreen scroll overlay-dark-alpha-30"
                         data-background="{{ asset('website_assets/images/home/image_2.jpg') }}">
                </section>
                <!-- End Slide Item -->
            </div>
            <div class="item">
                <!-- Slide Item -->
                <section class="page-section fullscreen scroll overlay-dark-alpha-30"
                         data-background="{{ asset('website_assets/images/home/slider-2.jpg') }}">
                </section>
                <!-- End Slide Item -->
            </div>
        </div>
        <div class="slider-navigation-right">
            <div class="nav-right"></div>
        </div>
        <div class="slider-navigation-left">
            <div class="nav-left"></div>
        </div>
    </section>

    <!-- SECTION COURSES FOR KID
    ================================================== -->
    <section id="courses_for_kid" class="page-section big-section">
        <div class="shadow-title shadow-gray unselectable parallax-1">Khóa học</div>
        <div class="container relative">
            <h2 class="font-face1 section-heading fw800 mt-0 mb-60 mb-sm-40 text-center">Khóa học cho trẻ em</h2>
            <div class="block-grid block-item-3 block-grid-gut masonry clearfix">
                @foreach($forChildrenCourses as $course)
                    @include('website.elements.course-item', ['course' => $course])
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION ADVANCE COURSES
    ================================================== -->
    <section id="courses_for_adult" class="page-section big-section">
        <div class="shadow-title shadow-gray unselectable parallax-1">Khóa học</div>
        <div class="container relative">
            <h2 class="font-face1 section-heading fw800 mt-0 mb-60 mb-sm-40 text-center">Khóa học cho người lớn</h2>
            <div class="block-grid block-item-3 block-grid-gut masonry clearfix">
                @foreach($forAdultsCourses as $course)
                    @include('website.elements.course-item', ['course' => $course])
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION TESTIMONIAL
    ================================================== -->
{{--    <section id="testimonial" class="page-section black-section medium-section overlay-dark-alpha-60"--}}
{{--             data-background="{{ asset('website_assets/images/home/image_8.jpg') }}">--}}
{{--        <div class="container relative">--}}
{{--            <div class="row">--}}
{{--                <div class="col-sm-10 col-sm-offset-1">--}}
{{--                    <div class="block-wraper">--}}
{{--                        <!-- Swiper -->--}}
{{--                        <!-- Add Pagination -->--}}

{{--                        <div class="slick-container testimonial-slider">--}}

{{--                            <div class="slick-item">--}}
{{--                                <div class="testimonial-item text-center">--}}
{{--                                    <blockquote class="testimonial-text font-face1 mb-0 fw300">--}}
{{--                                        <div class="card-avatar">--}}
{{--                                            <a href="javascript:void(0)">--}}
{{--                                                <img src="{{ asset('website_assets/images/faces/face-img1.jpg') }}"--}}
{{--                                                     class="img" alt=""/>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <p>--}}
{{--                                            I speak yell scream directly at the old guard on behalf of the future. I--}}
{{--                                            gotta say at that time I'd like to meet Kanye I speak yell scream--}}
{{--                                            directly at the old guard on behalf of the future.--}}
{{--                                        </p>--}}
{{--                                        <footer class="testimonial-author font-face1 fw700">--}}
{{--                                            Mike Andrew, CEO @ Marketing Digital Ltd.--}}
{{--                                            <div class="testimonial-rating mt-10 mb-10">&starf; &starf; &starf;--}}
{{--                                                &starf; &starf;--}}
{{--                                            </div>--}}
{{--                                        </footer>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slick-item">--}}
{{--                                <div class="testimonial-item text-center">--}}
{{--                                    <blockquote class="testimonial-text font-face1 mb-0 fw300">--}}
{{--                                        <div class="card-avatar">--}}
{{--                                            <a href="javascript:void(0)">--}}
{{--                                                <img src="{{ asset('website_assets/images/faces/face-img2.jpg') }}"--}}
{{--                                                     class="img" alt=""/>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <p>--}}
{{--                                            I promise I will never let the people down. I want a better life for--}}
{{--                                            all!!! Pablo Pablo Pablo Pablo! Thank you Anna for the invite thank you--}}
{{--                                            to the whole Vogue team It wasn�t any Kanyes I love Rick Owens.--}}
{{--                                        </p>--}}
{{--                                        <footer class="testimonial-author">--}}
{{--                                            Tina Thompson, Marketing @ Apple Inc.--}}
{{--                                            <div class="testimonial-rating mt-10 mb-10">&starf; &starf; &starf;--}}
{{--                                                &starf; &starf;--}}
{{--                                            </div>--}}
{{--                                        </footer>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slick-item">--}}
{{--                                <div class="testimonial-item text-center">--}}
{{--                                    <blockquote class="testimonial-text font-face1 mb-0 fw300">--}}
{{--                                        <div class="card-avatar">--}}
{{--                                            <a href="javascript:void(0)">--}}
{{--                                                <img src="{{ asset('website_assets/images/faces/face-img3.jpg') }}"--}}
{{--                                                     class="img" alt=""/>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <p>--}}
{{--                                            Your products, all the kits that I have downloaded from your site and--}}
{{--                                            worked with are sooo cool! I love the color mixtures, cards...--}}
{{--                                            everything. Keep up the great work!"--}}

{{--                                        </p>--}}
{{--                                        <footer class="testimonial-author">--}}
{{--                                            Gina West, CFO @ Apple Inc.--}}
{{--                                            <div class="testimonial-rating mt-10 mb-10">&starf; &starf; &starf;--}}
{{--                                                &starf; &starf;--}}
{{--                                            </div>--}}
{{--                                        </footer>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slick-item">--}}
{{--                                <div class="testimonial-item text-center">--}}
{{--                                    <blockquote class="testimonial-text font-face1 mb-0 fw300">--}}
{{--                                        <div class="card-avatar">--}}
{{--                                            <a href="javascript:void(0)">--}}
{{--                                                <img--}}
{{--                                                    src="{{ asset('website_assets/images/faces/face-img1.jpg') }}"--}}
{{--                                                    class="img" alt=""/>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                        <p>--}}
{{--                                            Your products, all the kits that I have downloaded from your site and--}}
{{--                                            worked with are sooo cool! I love the color mixtures, cards...--}}
{{--                                            everything. Keep up the great work!--}}

{{--                                        </p>--}}
{{--                                        <footer class="testimonial-author">--}}
{{--                                            John Doe, doodle inc.--}}
{{--                                            <div class="testimonial-rating mt-10 mb-10">&starf; &starf; &starf;--}}
{{--                                                &starf; &starf;--}}
{{--                                            </div>--}}
{{--                                        </footer>--}}
{{--                                    </blockquote>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="slider-navigation-bottom">--}}
{{--            <div class="testimonial-right"></div>--}}
{{--        </div>--}}
{{--        <div class="slider-navigation-top">--}}
{{--            <div class="testimonial-left"></div>--}}
{{--        </div>--}}
{{--    </section>--}}

@stop

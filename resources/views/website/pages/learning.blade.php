@extends('website.layouts.master')
@section('pageTitle', 'Học')

@section('css')
    <link rel="stylesheet" href="//unpkg.com/plyr@3/dist/plyr.css"/>
@stop

@section('content')
    <!-- SECTION STUDYING
				================================================== -->
    <section id="studying" class="page-section">
        <div class="relative">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="row wow fadeIn">
                    <div class="articles-course">
                        <div class="course-wrap">
                            <div class="course-body course-body-title-only text-left">
                                <h2 class="section-heading lp-0 mt-0 font-face1 text-left">{{ $course->name }}</h2>
                                <hr class="nopadding"/>

                                @foreach($course->lessons as $lesson)
                                    <div class="lesson js_lesson_item">
                                        <div class="lesson-name lp-0 mt-0 font-face1 text-left">
                                            <h4>{{ $lesson->name }}</h4>
                                        </div>
                                        <a class="btn bg-white js_open_video"
                                           data-video-url="{{ $lesson->getVideoUrl() }}"
                                           data-sample-picture-one="{{ $lesson->getSamplePicture1() }}"
                                           data-sample-picture-two="{{ $lesson->getSamplePicture2() }}"
                                           data-lesson-id="{{ $lesson->id }}"
                                           href="javascript:void(0);">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <hr class="nopadding"/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <button class="btn-sample-picture" data-toggle="modal" data-target="#sample_picture_modal">Xem tranh mẫu</button>
                <button class="btn-upload-picture" id="btn-upload-picture">Nộp bài vẽ</button>
                <button class="btn-buy-tool" data-toggle="modal" data-target="#buy_tool_modal">Mua hoạ cụ</button>
                <div class="row fadeIn">
                    <div class="lesson-video">
                        <video id="js_learning_video" controls crossorigin playsinline>
                            <source
                                type="application/x-mpegURL"
                                src=""
                            >
                        </video>
                        <video id="play-video-ios" controls style="display: none; width: 100%" height="300" src="">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="sample_picture_modal" tabindex="-1"
         role="dialog" aria-labelledby="sample_picture_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tranh mẫu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="" alt="" id="sample-picture-1" style="width: 100%">
                    <img src="" alt="" id="sample-picture-2" style="width: 100%">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="upload_picture_modal" tabindex="-1"
         role="dialog" aria-labelledby="upload_picture_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nộp bài vẽ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_post_student_picture">
                        @csrf
                        <div class="form-group">
                            <label for="image">Tranh đã vẽ</label>
                            <input type="file" id="js_image_input">
                            <input type="hidden" name="lesson_id" id="lesson_id">
                            <input type="hidden" id="image" name="image" value="{{ old('image') }}"
                                   accept=".png,.jpg,.jepg">

                            <div class="js_image_render"
                                 data-image="{{ old('image') ?
                                    \Illuminate\Support\Facades\Storage::url(old('image')) : ''}}"></div>
                        </div>
                        <button class="btn-upload-picture">Nộp bài vẽ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="buy_tool_modal" tabindex="-1"
         role="dialog" aria-labelledby="upload_picture_modal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mua hoạ cụ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="modal-title">Danh sách hoạ cụ</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tools as $index => $tool)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $tool->name }}</td>
                            <td>{{ $tool->description }}</td>
                            <td>{{ $tool->price }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group">
                        <label>Địa chỉ giao hàng</label>
                        <input type="email" class="form-control" id="address"name="address">
                    </div>
                    <button class="btn-buy-tool" id="buy-tool">Mua toàn bộ hoạ cụ</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="//unpkg.com/plyr@3"></script>

    <script>
        function makeVideo(source, video) {
            // For more options see: https://github.com/sampotts/plyr/#options
            // captions.update is required for captions to work with hls.js
            const defaultOptions = {};

            if (Hls.isSupported()) {
                // For more Hls.js options, see https://github.com/dailymotion/hls.js
                const hls = new Hls();
                hls.loadSource(source);

                // From the m3u8 playlist, hls parses the manifest and returns
                // all available video qualities. This is important, in this approach,
                // we will have one source on the Plyr player.
                hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

                    // Transform available levels into an array of integers (height values).
                    const availableQualities = hls.levels.map((l) => l.height)

                    // Add new qualities to option
                    defaultOptions.quality = {
                        default: availableQualities[0],
                        options: availableQualities,
                        // this ensures Plyr to use Hls to update quality level
                        forced: true,
                        onChange: (e) => updateQuality(e),
                    }

                    // Initialize here
                    const player = new Plyr(video, defaultOptions);
                });
                hls.attachMedia(video);
                window.hls = hls;
            } else {
                // default options with no quality update in case Hls is not supported
                const player = new Plyr(video, defaultOptions);
            }

            function updateQuality(newQuality) {
                window.hls.levels.forEach((level, levelIndex) => {
                    if (level.height === newQuality) {
                        // console.log("Found quality match with " + newQuality);
                        window.hls.currentLevel = levelIndex;
                    }
                });
            }
        }

        let globalLessonID = 0;

        $(document).on('click', '.js_lesson_item .js_open_video', function (event) {
            event.preventDefault();

            const button = $(this);
            const videoUrl = button.data('videoUrl');
            const samplePicture1 = button.data('sample-picture-one');
            const samplePicture2 = button.data('sample-picture-two');
            const lessonID = button.data('lesson-id');
            const videoElement = document.querySelector("video#js_learning_video");

            $("#sample-picture-1").attr("src", samplePicture1)
            $("#sample-picture-2").attr("src", samplePicture2)
            $("#lesson_id").val(lessonID)
            globalLessonID = lessonID

            $('.js_lesson_item.active').removeClass('active');
            button.closest('.js_lesson_item').addClass('active');

            if( /iPhone|iPad/i.test(navigator.userAgent) ) {
                console.log('ios');
                $('#js_learning_video').hide()
                $('#play-video-ios').show()
                $('#play-video-ios').attr('src', videoUrl)
            } else {
                console.log('not ios');
                makeVideo(videoUrl, videoElement);
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const firstLessonItem = $('.js_lesson_item').first();

            if (firstLessonItem) {
                firstLessonItem.find('.js_open_video').click();
            }
        });

        function renderImage() {
            const renderElement = $('.js_image_render');
            const url = renderElement.attr('data-image');

            renderElement.html(url.length ?
                '<img src="' + url + '" alt="Ảnh đại diện" title="Ảnh đại diện" style = "max-height: 200px;" >'
                : '');
        }

        let imageUploaded = "";

        $(document).on('change', '#js_image_input', function () {
            const file = $(this)[0].files[0];

            if (!file) {
                return;
            }

            const formData = new FormData();

            formData.append("file", file, file.name);
            formData.append("path", 'course/image');

            $.ajax({
                type: "POST",
                url: "{{ route('website.upload') }}",
                data: formData,
                success: function (data) {
                    if (data.status) {
                        $('.js_image_render').attr('data-image', data.data.url);
                        $('#image').val(data.data.path);
                        imageUploaded = data.data.path;
                        renderImage();
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message + ': ' + data.error);
                    }
                },
                error: function (error) {
                    toastr.error('Something went wrong!!');
                },
                async: true,
                cache: false,
                contentType: false,
                processData: false,
            });
        })

        $(document).on("submit", "#form_post_student_picture", function () {
            $.ajax({
                type: 'POST',
                url: "{{ route('website.learning.post_student_picture') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'lesson_id': globalLessonID,
                    'picture': imageUploaded
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message + ': ' + data.error);
                    }
                },
                error: function (error) {
                    console.log(error)
                },
            });
        })

        $(document).on("click", "#btn-upload-picture", function () {
            $.ajax({
                type: 'POST',
                url: "{{ route('website.learning.check_student_picture') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'lesson_id': globalLessonID,
                },
                success: function (data) {
                    console.log(data)
                    if (data.status) {
                        if(data.is_posted) {
                            toastr.error(data.message);
                        } else {
                            $('#upload_picture_modal').modal("show")
                        }
                    } else {
                        toastr.error(data.message + ': ' + data.error);
                    }
                },
                error: function (error) {
                    console.log(error)
                },
            });
        })

        $(document).on("click", "#buy-tool", function () {
            $.ajax({
                type: 'POST',
                url: "{{ route('website.course.buy_tool') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'course_id': {{ $course->id }},
                    'address': $("#address").val()
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message + ': ' + data.error);
                    }
                    $('#buy_tool_modal').modal("hide")
                },
                error: function (error) {
                    console.log(error)
                },
            });
        })
    </script>
@stop

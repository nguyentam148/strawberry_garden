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

        $(document).on('click', '.js_lesson_item .js_open_video', function (event) {
            event.preventDefault();

            const button = $(this);
            const videoUrl = button.data('videoUrl');
            const videoElement = document.querySelector("video#js_learning_video");

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
    </script>
@stop

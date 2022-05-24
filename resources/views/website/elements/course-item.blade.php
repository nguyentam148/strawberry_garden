<div
    class="{{ !empty($isProfile) ? 'col-sm-6 col-md-6 col-lg-6 mb-md-50' : 'col-sm-6 col-md-4 col-lg-4 mb-md-50' }} item-course" style="left: unset; top: unset">
    <div class="articles-course">
        <div class="course-wrap">
            <div class="course-image">
                <div class="article-thumbnail"
                     data-background="{{ $course->getImageUrl() }}"></div>
            </div>
            <div class="course-body text-left" style="height: 350px;">
                <h4 class="heading6 lp-0 mt-0 font-face1 text-left">{{ $course->name }}</h4>
                <p>{{ $course->excerpt }}</p>
            </div>
            <div class="course-footer">
                @if($course->student_status === \App\Models\CourseStudent::STATUS_ACCEPTED)
                    <a class="btn bg-white" href="{{ route('website.course.learn', $course->slug) }}" style="background-color: #80ab3f; color: #ffffff;">
                        Vào học
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                @else
                    <a class="btn bg-white" href="{{ route('website.course.show', $course->slug) }}"  style="background-color: #80ab3f; color: #ffffff;">
                        {{ number_format($course->getCurrentPrice(), 0, ',', '.')  }} VNĐ

                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="sessions light-text"><span>{{ $course->lessons_count }} buổi</span></div>
</div>

<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendAcceptCourseForStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $student;
    public $courseStudent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, Course $course, CourseStudent $courseStudent)
    {
        $this->student = $student;
        $this->course = $course;
        $this->courseStudent = $courseStudent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $appName = config('app.name');
        $isAccepted = $this->courseStudent->isAccepted();

        return $this
            ->subject("Thông báo phê duyệt thành công đăng ký khoá học vẽ online tại Lớp Vẽ Online")
            ->view('mails.accept_course_for_student', compact('isAccepted'));
    }
}

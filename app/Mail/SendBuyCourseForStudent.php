<?php

namespace App\Mail;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBuyCourseForStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $course;
    public $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Student $student, Course $course)
    {
        $this->student = $student;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject("Chào mừng Quý học viên đã đăng ký khoá học vẽ online tại Lớp Vẽ Online")
            ->view('mails.buy_course_for_student');
    }
}

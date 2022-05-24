<?php

namespace App\Models;

use App\Mail\SendAcceptCourseForStudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

/**
 * Class CourseStudent
 * @package App\Models
 *
 * @property int $status
 *
 * @property Course $course
 * @property Student $student
 */
class CourseStudent extends Model
{
    use SoftDeletes;

    protected $table = 'course_student';
    protected $guarded = [];

    public const STATUS_WAIT_ACCEPT = 1;
    public const STATUS_ACCEPTED = 2;
    public const STATUS_CANCELLED = 3;
    public const STATUS_DENIED = 4;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function isWaitForAccepting()
    {
        return $this->status === self::STATUS_WAIT_ACCEPT;
    }

    public function isAccepted()
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    public function isDenied()
    {
        return $this->status === self::STATUS_DENIED;
    }

    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    public function getStatusText(): string
    {
        switch ($this->status) {
            case self::STATUS_WAIT_ACCEPT:
                return 'Chờ xác nhận';
            case self::STATUS_ACCEPTED:
                return 'Đã xác nhận';
            case self::STATUS_DENIED:
                return 'Đã từ chối';
            case self::STATUS_CANCELLED:
                return 'Đã huỷ';
            default:
                return '';
        }
    }

    public function getStatusHtmlClass()
    {
        switch ($this->status) {
            case self::STATUS_WAIT_ACCEPT:
                return 'primary';
            case self::STATUS_ACCEPTED:
                return 'success';
            case self::STATUS_DENIED:
            case self::STATUS_CANCELLED:
                return 'danger';
            default:
                return '';
        }
    }

    public function changeStatus(int $status)
    {
        $this->status = $status;
        $this->save();

        // Gửi mail khi admin accept khoá học.
        // Từ chối thì không gửi mail.
        if (in_array($status, [self::STATUS_ACCEPTED/*, self::STATUS_DENIED*/])) {
            $student = $this->student;

            Mail::to($student->email)->send(
                new SendAcceptCourseForStudent($student, $this->course, $this)
            );
        }

        return $this;
    }
}

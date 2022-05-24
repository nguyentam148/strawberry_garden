<?php

namespace App\Models;

use App\Helpers\GlobalHelper;
use App\Mail\SendBuyCourseForAdmin;
use App\Mail\SendBuyCourseForStudent;
use App\Mail\SendLinkResetPassword;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

/**
 * Class Student
 * @package App\Models
 *
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $reset_password_token
 * @property string $reset_password_token_expired
 */
class Student extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getFullName()
    {
        return $this->last_name;
    }

    public static function checkExistByEmail(string $email)
    {
        return self::query()->where('email', $email)->exists();
    }

    public static function register(array $data)
    {
        $student = new self($data);
        $student->password = Hash::make($data['password']);

        $student->save();

        return $student;
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_student');
    }

    public function getMyCourses()
    {
        return $this->courses()
            ->with('lessons')
            ->withPivot('status', 'created_at')
            ->where('course_student.status', CourseStudent::STATUS_ACCEPTED)
            ->orderBy('course_student.created_at', 'desc')
            ->withStudentStatus([
                DB::raw('(select count(id) from lessons
                                        where courses.id = lessons.course_id
                                        and lessons.deleted_at is null
                               ) as lessons_count'
                )
            ])
            ->get();
    }

    public function checkMyCourse(Course $course)
    {
        return $this->courses()
            ->withPivot('status')
            ->where('course_student.status', CourseStudent::STATUS_ACCEPTED)
            ->where('course_id', $course->getKey())
            ->exists();
    }

    public function buyCourse(Course $course)
    {
        CourseStudent::query()->updateOrCreate([
            'student_id' => $this->getKey(),
            'course_id' => $course->getKey(),
        ], ['status' => CourseStudent::STATUS_WAIT_ACCEPT]);

        Mail::to($this->email)->send(new SendBuyCourseForStudent($this, $course));
        GlobalHelper::sendMailToAdmin(new SendBuyCourseForAdmin($this, $course));
    }

    public static function firstByEmail(string $email)
    {
        return self::query()
            ->where('email', $email)
            ->first();
    }

    public function forgotPassword()
    {
        $this->reset_password_token = md5(Str::random(32) . $this->email);
        $this->reset_password_token_expired = Carbon::now()->addHour();

        $this->save();

        Mail::to($this->email)->send(new SendLinkResetPassword($this));
    }

    public static function firstByResetPasswordToken(string $token)
    {
        return self::query()
            ->where('reset_password_token', $token)
            ->where('reset_password_token_expired', '>=', Carbon::now()->format('Y-m-d H:i:s'))
            ->first();
    }

    public function resetPassword(string $password)
    {
        $this->password = Hash::make($password);
        $this->reset_password_token = null;
        $this->reset_password_token_expired = null;

        $this->save();
    }

    public function getLinkResetPassword()
    {
        return route('website.students.reset_password', $this->reset_password_token);
    }

    public function checkPassword(string $password = null)
    {
        if (is_null($password)) {
            return false;
        }

        return Hash::check($password, $this->password);
    }

    public function changePassword(string $password)
    {
        $this->password = Hash::make($password);
        $this->save();
    }
}

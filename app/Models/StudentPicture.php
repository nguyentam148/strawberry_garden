<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPicture extends Model
{
    protected $table = 'student_pictures';
    protected $guarded = [];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

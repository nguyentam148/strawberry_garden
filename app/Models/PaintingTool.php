<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaintingTool extends Model
{
    protected $table = 'painting_tools';
    protected $guarded = [];

    public static function getCourses()
    {
        return Course::query()->get();
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_painting_tools');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

/**
 * Class Lesson
 * @package App\Models
 *
 * @property string $name
 * @property int $course_id
 * @property string $video_path
 *
 * @property Course $course
 */
class Lesson extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function getCourses()
    {
        return Course::query()->get();
    }

    public function getVideoUrl()
    {
        if (is_null($this->video_path)) {
            return '';
        }

        return Storage::disk('public')
            ->url("videos/{$this->video_path}/master.m3u8");
    }
}

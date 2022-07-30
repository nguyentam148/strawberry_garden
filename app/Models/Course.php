<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class Course
 * @package App\Models
 *
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property double $learn_price
 * @property double $learn_price_discount
 * @property double $people_type
 */
class Course extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public const PEOPLE_TYPE_FOR_ALL = 1;
    public const PEOPLE_TYPE_FOR_CHILDREN = 2;

    public const LEARN_TYPE_ONLINE = 1;

    public const PAPER_TYPE_ROKI = 1;
    public const PAPER_TYPE_HAPPY = 2;
    public const PAPER_TYPE_TOAN = 3;

    protected static function boot()
    {
        parent::boot();

        self::saving(function (Course $row) {
            if ($row->isDirty('name')) {
                $row->slug = $row->generateSlug();
            }
        });
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function painting_tool()
    {
        return $this->belongsToMany(PaintingTool::class, "course_painting_tools", "course_id", "painting_tool_id");
    }

    public static function getPeopleTypes(bool $onlyKey = false): array
    {
        $data = [
            self::PEOPLE_TYPE_FOR_ALL => [
                'name' => 'Người lớn'
            ],
            self::PEOPLE_TYPE_FOR_CHILDREN => [
                'name' => 'Trẻ em'
            ]
        ];

        return $onlyKey ? array_keys($data) : $data;
    }

    public function getPeopleTypeText(): string
    {
        return self::getPeopleTypes()[$this->people_type]['name'];
    }

    public static function getLearnTypes(bool $onlyKey = false): array
    {
        $data = [
            self::LEARN_TYPE_ONLINE => [
                'name' => 'Online'
            ],
        ];

        return $onlyKey ? array_keys($data) : $data;
    }

    public static function getPaperTypes(bool $onlyKey = false): array
    {
        $data = [
            self::PAPER_TYPE_ROKI => [
                'name' => 'Giấy Roki'
            ],
            self::PAPER_TYPE_HAPPY => [
                'name' => 'Giấy Happy'
            ],
            self::PAPER_TYPE_TOAN => [
                'name' => 'Toan'
            ]
        ];

        return $onlyKey ? array_keys($data) : $data;
    }

    public function generateSlug(): string
    {
        $name = $this->name;
        $copyNumber = 0;

        do {
            if ($copyNumber) {
                $name .= " {$copyNumber}";
            }

            $slug = Str::slug($name);
            $copyNumber++;
        } while (self::query()->where('slug', $slug)->exists());

        return $slug;
    }

    public function getImageUrl(): string
    {
        return $this->image ? Storage::url($this->image) : '';
    }

    public function getCurrentPrice()
    {
        return $this->learn_price;
    }

    public function scopeWithStudentStatus(Builder $query, array $selects = [])
    {
        /** @var Student $student */
        if (!$student = auth(config('project.auth_guard.website'))->user()) {
            return $query;
        }

        $studentId = $student->getKey();

        return $query
            ->select(array_merge($selects, [
                'courses.*',
                DB::raw('(select (case
                        when cs.status = ' . CourseStudent::STATUS_WAIT_ACCEPT . ' then ' . CourseStudent::STATUS_WAIT_ACCEPT
                    . ' when cs.status = ' . CourseStudent::STATUS_ACCEPTED . ' then ' . CourseStudent::STATUS_ACCEPTED
                    . ' else 0 end) as student_status from course_student as cs'
                    . ' where cs.student_id = ' . $studentId
                    . ' and cs.course_id = courses.id'
                    . ' and cs.deleted_at is null order by cs.created_at desc limit 1) as student_status'
                )
            ]));
    }

    public static function getByPeopleType(int $peopleType)
    {
        return self::query()
            ->withCount('lessons')
            ->where('people_type', $peopleType)
            ->withStudentStatus([
                DB::raw('(select count(id) from lessons
                                        where courses.id = lessons.course_id
                                        and lessons.deleted_at is null
                               ) as lessons_count'
                )
            ])->orderBy('id', 'DESC')
            ->get();
    }
}

<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class WebsiteController extends Controller
{
    public function home()
    {
        $forChildrenCourses = Course::getByPeopleType(Course::PEOPLE_TYPE_FOR_CHILDREN);
        $forAdultsCourses = Course::getByPeopleType(Course::PEOPLE_TYPE_FOR_ALL);

        return view('website.pages.home', compact(
            'forChildrenCourses',
            'forAdultsCourses'
        ));
    }

    public function showCourse($slug)
    {
        $course = Course::query()
            ->with('lessons')
            ->where('slug', $slug)
            ->withStudentStatus();

        if (!$course = $course->first()) {
            abort('404');
        }

        return view('website.pages.course', compact('course'));
    }

    public function learnCourse(Request $request, $slug)
    {
        /** @var Student $student */
        $student = $request->user(config('project.auth_guard.website'));

        /** @var Course $course */
        $course = Course::query()
            ->with('lessons')
            ->where('slug', $slug)
            ->first();

        if (!$course || !$student->checkMyCourse($course)) {
            abort('404');
        }

        return view('website.pages.learning', compact('course'));
    }
}

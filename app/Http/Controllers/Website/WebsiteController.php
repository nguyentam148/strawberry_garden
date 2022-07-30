<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Student;
use App\Models\StudentPicture;
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

        $tools = $course->painting_tool;

        return view('website.pages.learning', compact('course', 'tools'));
    }

    public function postStudentPicture(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
            'picture' => 'required|string'
        ]);

        $student = $request->user(config('project.auth_guard.website'));
        $data = $request->only('lesson_id', 'picture');

        StudentPicture::create([
            'student_id' => $student->id,
            'lesson_id' => $data['lesson_id'],
            'picture' => $data['picture'],
        ]);

        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'message' => 'Nộp bài thành công.',
        ]);
    }

    public function checkStudentPicture(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required',
        ]);
        $data = $request->only('lesson_id');

        $student = $request->user(config('project.auth_guard.website'));

        $studentPicture = StudentPicture::where("student_id", $student->id)->where("lesson_id", $data['lesson_id'])->first();

        if ($studentPicture) {
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Bạn đã nộp bài, không thể nộp lại',
                'is_posted' => true
            ]);
        } else {
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'is_posted' => false
            ]);
        }

    }

    public function buyTool(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'address' => 'required|string',
        ]);

        $data = $request->only('course_id', 'address');
        $student = $request->user(config('project.auth_guard.website'));
        $course = Course::find($data['course_id']);
        $totalPrice = $course->painting_tool->pluck("price")->sum();

        $order = Order::create([
            "address" => $data["address"],
            "total_price" => $totalPrice,
            "student_id" => $student->id,
        ]);

        foreach ($course->painting_tool as $tool) {
            OrderItem::create([
                "order_id" => $order->id,
                "painting_tool_id" => $tool->id,
            ]);
        }

        return response()->json([
            'status' => true,
            'statusCode' => 200,
            'message' => 'Bạn đã đặt mua toàn bộ hoạ cụ thành công',
        ]);
    }
}

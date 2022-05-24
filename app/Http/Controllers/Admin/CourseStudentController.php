<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use Illuminate\Http\Request;
use Throwable;

class CourseStudentController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new CourseStudent();
    }

    public function list()
    {
        $rows = $this->model->query()
            ->whereHas('course')
            ->whereHas('student')
            ->orderBy('status')
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);

        return view('admin.course_student.list', compact('rows'));
    }

    public function accept($id)
    {
        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Yêu cầu khoá học không tồn tại.');
            }

            $row->changeStatus($this->model::STATUS_ACCEPTED);

            return redirect()
                ->route('admin.course_student.list')
                ->with('successMsg', 'Đồng ý khoá học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Đồng ý khoá học thất bại.');
        }
    }

    public function deny($id)
    {
        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Yêu cầu khoá học không tồn tại.');
            }

            $row->changeStatus($this->model::STATUS_DENIED);

            return redirect()
                ->route('admin.course_student.list')
                ->with('successMsg', 'Từ chối khoá học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Từ chối khoá học thất bại.');
        }
    }
}

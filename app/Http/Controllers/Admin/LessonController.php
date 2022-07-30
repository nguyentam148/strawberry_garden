<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class LessonController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Lesson();
    }

    public function list()
    {
        $rows = $this->model->query()
            ->whereHas('course')
            ->with('course')
            ->simplePaginate(10);

        return view('admin.lessons.list', compact('rows'));
    }

    public function create()
    {
        return view('admin.lessons.edit-add', [
            'row' => $this->model,
            'sample_picture' => ["", ""],
            'isEdit' => false,
            'courses' => $this->model->getCourses()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->getStoreUpdateValidateRules());
        DB::beginTransaction();
        try {
            $lesson = $this->model->query()->create($request->only("name", "course_id", "video_path"));
            $lesson->sample_picture()->create(["picture" => $request->image_1]);
            if ($request->image_2) {
                $lesson->sample_picture()->create(["picture" => $request->image_2]);
            }

            DB::commit();
            return redirect()
                ->route('admin.lessons.list')
                ->with('successMsg', 'Thêm mới bài học thành công.');
        } catch (Throwable $exception) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('errorMsg', 'Thêm mới bài học thất bại.');
        }
    }

    public function edit($id)
    {
        if (!$row = $this->model->query()->find($id)) {
            abort('404');
        }

        return view('admin.lessons.edit-add', [
            'row' => $row,
            'sample_picture' => [
                $row->sample_picture->pluck("picture")->toArray()[0],
                $row->sample_picture->pluck("picture")->toArray()[1] ?? ""
            ],
            'isEdit' => true,
            'courses' => $this->model->getCourses()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->getStoreUpdateValidateRules());

        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Bài học không tồn tại.');
            }

            $row->update($request->only("name", "course_id", "video_path"));
            $row->sample_picture()->delete();
            $row->sample_picture()->create(["picture" => $request->image_1]);
            if ($request->image_2) {
                $row->sample_picture()->create(["picture" => $request->image_2]);
            }

            return back()->with('successMsg', 'Cập nhật bài học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Cập nhật bài học thất bại.');
        }
    }

    public function destroy($id)
    {
        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Bài học không tồn tại.');
            }

            $row->delete();

            return back()->with('successMsg', 'Xoá bài học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Xoá bài học thất bại.');
        }
    }

    private function getStoreUpdateValidateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'course_id' => 'required|integer|min:1',
            'video_path' => 'nullable|string|max:100',
            'image_1' => 'required|string|max:255',
            'image_2' => 'nullable|string|max:255',
        ];
    }
}

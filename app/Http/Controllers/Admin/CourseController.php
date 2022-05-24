<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class CourseController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Course();
    }

    public function list()
    {
        $rows = $this->model->query()->simplePaginate(10);

        return view('admin.courses.list', compact('rows'));
    }

    public function create()
    {
        return view('admin.courses.edit-add', [
            'row' => $this->model,
            'isEdit' => false,
            'peopleTypes' => $this->model->getPeopleTypes(),
            'learnTypes' => $this->model->getLearnTypes(),
            'paperTypes' => $this->model->getPaperTypes()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->getStoreUpdateValidateRules());

        try {
            $this->model->query()->create($request->all());

            return redirect()
                ->route('admin.courses.list')
                ->with('successMsg', 'Thêm mới khoá học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Thêm mới khoá học thất bại.');
        }
    }

    public function edit($id)
    {
        if (!$row = $this->model->query()->find($id)) {
            abort('404');
        }

        return view('admin.courses.edit-add', [
            'row' => $row,
            'isEdit' => true,
            'peopleTypes' => $this->model->getPeopleTypes(),
            'learnTypes' => $this->model->getLearnTypes(),
            'paperTypes' => $this->model->getPaperTypes()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->getStoreUpdateValidateRules());

        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Khoá học không tồn tại.');
            }

            $row->update($request->all());

            return redirect()
                ->route('admin.courses.list')
                ->with('successMsg', 'Cập nhật khoá học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Cập nhật khoá học thất bại.');
        }
    }

    public function destroy($id)
    {
        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Khoá học không tồn tại.');
            }

            $row->delete();

            return back()->with('successMsg', 'Xoá khoá học thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Xoá khoá học thất bại.');
        }
    }

    private function getStoreUpdateValidateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string|max: 1000',
            'description_1' => 'nullable|string',
            // 'description_2' => 'nullable|string',
            // 'teacher_name' => 'required|string|max:100',
            'people_type' => ['required', Rule::in($this->model->getPeopleTypes(true))],
            // 'learn_type' => ['required', Rule::in($this->model->getLearnTypes(true))],
            // 'paper_type' => ['required', Rule::in($this->model->getPaperTypes(true))],
            // 'age_range' => 'nullable|string|max:50',
            // 'learn_time' => 'nullable|string|max:50',
            'learn_price' => 'required|integer|min:0|max:99999999',
            // 'learn_price_discount' => 'nullable|integer|min:0|max:99999999',
            // 'learn_price_for_tools' => 'nullable|integer|min:0|max:99999999',
        ];
    }
}

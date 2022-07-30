<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseStudent;
use App\Models\PaintingTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ToolController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new PaintingTool();
    }

    public function list()
    {
        $rows = $this->model->query()
            ->orderBy('created_at', 'desc')
            ->simplePaginate(10);

        return view('admin.tools.list', compact('rows'));
    }


    public function create()
    {
        return view('admin.tools.edit-add', [
            'row' => $this->model,
            'isEdit' => false,
            'courses' => $this->model->getCourses()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->getStoreUpdateValidateRules());

        DB::beginTransaction();
        try {
            $tool = $this->model->query()->create($request->only("name", "price", "description"));
            $tool->course()->attach($request->get("course_id"));
            DB::commit();
            return redirect()
                ->route('admin.tool.list')
                ->with('successMsg', 'Thêm mới hoạ cụ thành công.');
        } catch (Throwable $exception) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('errorMsg', 'Thêm mới hoạ cụ thất bại.');
        }
    }

    public function edit($id)
    {
        if (!$row = $this->model->query()->find($id)) {
            abort('404');
        }

        return view('admin.tools.edit-add', [
            'row' => $row,
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
                    ->with('errorMsg', 'Hoạ cụ không tồn tại.');
            }

            $row->update($request->only("name", "price", "description"));
            $row->course()->sync($request->get("course_id"));

            return back()->with('successMsg', 'Cập nhật Hoạ cụ thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Cập nhật Hoạ cụ thất bại.');
        }
    }

    public function destroy($id)
    {
        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Hoạ cụ không tồn tại.');
            }

            $row->delete();

            return back()->with('successMsg', 'Xoá Hoạ cụ thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Xoá Hoạ cụ thất bại.');
        }
    }

    private function getStoreUpdateValidateRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'course_id' => 'required|array',
            'course_id.*' => 'required|integer|min:1',
            'price' => 'required|integer|min:1|max:100000000',
            'description' => 'required',
        ];
    }
}

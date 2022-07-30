<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentPicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class StudentPictureController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new StudentPicture();
    }

    public function list()
    {
        $rows = $this->model->query()
            ->whereHas('lesson')
            ->with('lesson')
            ->simplePaginate(10);

        return view('admin.student_picture.list', compact('rows'));
    }

    public function edit($id)
    {
        if (!$row = $this->model->query()->find($id)) {
            abort('404');
        }

        return view('admin.student_picture.edit-add', [
            'row' => $row,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate($this->getStoreUpdateValidateRules());

        try {
            if (!$row = $this->model->query()->find($id)) {
                return back()
                    ->withInput()
                    ->with('errorMsg', 'Tranh của học sinh không tồn tại.');
            }

            $row->update($request->only("scores", "comment"));

            return back()->with('successMsg', 'Chấm điểm thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withInput()
                ->with('errorMsg', 'Chấm điểm thành công.');
        }
    }

    private function getStoreUpdateValidateRules(): array
    {
        return [
            'scores' => 'required|integer|min:1|max:10',
            'comment' => 'required|string|max:255',
        ];
    }
}

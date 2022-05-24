<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;

class StudentController extends Controller
{
    public function list()
    {
        $rows = Student::query()->simplePaginate(10);

        return view('admin.students.list', compact('rows'));
    }
}

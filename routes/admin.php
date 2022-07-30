<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\CourseStudentController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\StudentPictureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('show_form_login');
Route::post('login', [LoginController::class, 'login'])->name('login');

Route::group([
    'middleware' => ['auth:' . config('project.auth_guard.admin')]
], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::post('upload', [AdminController::class, 'upload'])->name('upload');

    // Student Management.
    Route::get('students', [StudentController::class, 'list'])->name('students.list');

    // Course Management.
    Route::get('courses', [CourseController::class, 'list'])->name('courses.list');
    Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::get('courses/{id}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Lesson Management.
    Route::get('lessons', [LessonController::class, 'list'])->name('lessons.list');
    Route::get('lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('lessons/{id}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::post('lessons/{id}', [LessonController::class, 'update'])->name('lessons.update');
    Route::get('lessons/{id}/destroy', [LessonController::class, 'destroy'])->name('lessons.destroy');

    // Course Student Management.
    Route::get('course_student', [CourseStudentController::class, 'list'])
        ->name('course_student.list');
    Route::get('course_student/{id}/accept', [CourseStudentController::class, 'accept'])
        ->name('course_student.accept');
    Route::get('course_student/{id}/deny', [CourseStudentController::class, 'deny'])
        ->name('course_student.deny');

    // Tool Management.
    Route::get('tool', [ToolController::class, 'list'])->name('tool.list');
    Route::get('tool/create', [ToolController::class, 'create'])->name('tool.create');
    Route::post('tool', [ToolController::class, 'store'])->name('tool.store');
    Route::get('tool/{id}/edit', [ToolController::class, 'edit'])->name('tool.edit');
    Route::post('tool/{id}', [ToolController::class, 'update'])->name('tool.update');
    Route::get('tool/{id}/destroy', [ToolController::class, 'destroy'])->name('tool.destroy');

    // Order Management.
    Route::get('order', [OrdersController::class, 'list'])
        ->name('order.list');
//    Route::get('course_student/{id}/accept', [CourseStudentController::class, 'accept'])
//        ->name('course_student.accept');
//    Route::get('course_student/{id}/deny', [CourseStudentController::class, 'deny'])
//        ->name('course_student.deny');

    // Student Picture Management.
    Route::get('student_picture', [StudentPictureController::class, 'list'])->name('student_picture.list');
    Route::get('student_picture/{id}/edit', [StudentPictureController::class, 'edit'])->name('student_picture.edit');
    Route::post('student_picture/{id}', [StudentPictureController::class, 'update'])->name('student_picture.update');
});

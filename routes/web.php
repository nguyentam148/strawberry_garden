<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Website\StudentController;

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
Route::post('students/register', [StudentController::class, 'register'])->name('students.register');
Route::post('students/login', [StudentController::class, 'login'])->name('students.login');

Route::get('students/forgot-password', [StudentController::class, 'showFormForgotPassword'])
    ->name('students.forgot_password');
Route::post('students/forgot-password', [StudentController::class, 'sendLinkResetPassword']);
Route::get('students/reset-password/{token}', [StudentController::class, 'showFormResetPassword'])
    ->name('students.reset_password');
Route::post('students/reset-password/{token}', [StudentController::class, 'resetPassword']);

Route::group([
    'middleware' => ['auth:' . config('project.auth_guard.website')],
], function () {
    Route::get('/', [WebsiteController::class, 'home'])->name('home');
    Route::get('courses/{slug}', [WebsiteController::class, 'showCourse'])->name('course.show');

    Route::get('logout', [StudentController::class, 'logout'])->name('students.logout');
    Route::get('profile', [StudentController::class, 'profile'])->name('students.profile');
    Route::post('profile/update', [StudentController::class, 'update'])->name('students.profile.update');
    Route::post('buy-course/{course_id}', [StudentController::class, 'buyCourse'])->name('students.buy_course');

    Route::get('courses/{slug}/learning', [WebsiteController::class, 'learnCourse'])->name('course.learn');
});

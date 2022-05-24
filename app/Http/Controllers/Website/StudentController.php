<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'last_name' => 'required|string|max:50',
                    'email' => 'required|email|max:100',
                    'phone_number' => 'required|string|max:20',
                    'password' => 'required|string|max:40|min:6|confirmed',
                ],
                [
                    'required' => ':attribute là trường bắt buộc',
                    'email' => ':attribute chưa đúng định dạng email',
                    'max' => ':attribute chỉ được tối đa :max ký tự',
                    'min' => ':attribute phải có tối thiểu :min ký tự',
                    'confirmed' => 'Xác nhận mật khẩu không giống với mật khẩu',
                ],
                [
                    'last_name' => 'Họ tên',
                    'email' => 'Email',
                    'phone_number' => 'Số điện thoại',
                    'password' => 'Mật khẩu',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 422,
                    'message' => $validator->errors()->toArray(),
                ]);
            }

            if (Student::checkExistByEmail($request->get('email'))) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 422,
                    'message' => ['email' => ['Email đã tồn tại. Vui lòng thử lại']],
                ]);
            }

            Student::register($request->only('email', 'password', 'last_name', 'phone_number'));
            $this->attempt($request->only('email', 'password'));

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Đăng ký tài khoản thành công.',
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => __('custom.message.something_went_wrong'),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:100',
                    'password' => 'required|string|max:40',
                ],
                [
                    'required' => ':attribute là trường bắt buộc',
                    'email' => ':attribute chưa đúng định dạng email',
                    'max' => ':attribute chỉ được tối đa :max ký tự',
                ],
                [
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 422,
                    'message' => $validator->errors()->toArray(),
                ]);
            }

            if (!$this->attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 422,
                    'message' => ['email' => ['Tài khoản hoặc mật khẩu không đúng.']]
                ]);
            }

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Đăng nhập thành công.',
                /*'data' => [
                    'redirectUrl' => route('website.students.profile')
                ]*/
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => __('custom.message.something_went_wrong'),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $this->getAuth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return back();
    }

    private function attempt(array $data)
    {
        $auth = $this->getAuth();

        // Login thanh cong se logout toan bo
        // device khac dang dang nhap.
        if ($result = $auth->attempt($data)) {
            $auth->logoutOtherDevices(@$data['password']);
        }

        return $result;
    }

    private function getAuth()
    {
        return Auth::guard(config('project.auth_guard.website'));
    }

    public function profile(Request $request)
    {
        /** @var Student $student */
        $student = $request->user(config('project.auth_guard.website'));
        $myCourses = $student->getMyCourses();

        return view('website.pages.profile', compact('student', 'myCourses'));
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'last_name' => 'required|string|max:50',
                    'phone_number' => 'required|string|max:20',
                    'current_password' => 'nullable|required_with:password|string|max:40|min:6',
                    'password' => 'nullable|string|max:40|min:6|confirmed',
                ],
                [
                    'required' => ':attribute là trường bắt buộc',
                    'required_with' => ':attribute là trường bắt buộc',
                    'max' => ':attribute chỉ được tối đa :max ký tự',
                    'min' => ':attribute phải có tối thiểu :min ký tự',
                    'confirmed' => 'Xác nhận mật khẩu không giống với mật khẩu',
                ],
                [
                    'last_name' => 'Họ tên',
                    'phone_number' => 'Số điện thoại',
                    'password' => 'Mật khẩu',
                    'current_password' => 'Mật khẩu hiện tại',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 422,
                    'message' => $validator->errors()->toArray(),
                ]);
            }

            /** @var Student $student */
            $student = $request->user(config('project.auth_guard.website'));
            $student->update($request->only('last_name', 'phone_number'));

            if (!is_null($password = $request->get('password'))) {
                if (!$student->checkPassword($request->get('current_password'))) {
                    return response()->json([
                        'status' => false,
                        'statusCode' => 422,
                        'message' => ['current_password' => ['Mật khẩu hiện tại không chính xác']],
                    ]);
                }

                $student->changePassword($password);
            }

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Cập nhật tài khoản thành công.',
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => __('custom.message.something_went_wrong'),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function buyCourse(Request $request, $courseId)
    {
        try {
            /** @var Course $course */
            if (!$course = Course::query()->find($courseId)) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 404,
                    'message' => 'Không tìm thấy khoá học này.',
                ]);
            }

            /** @var Student $student */
            $student = $request->user(config('project.auth_guard.website'));
            $student->buyCourse($course);

            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'Đăng ký khoá học thành công.',
            ]);
        } catch (Throwable $exception) {
            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => __('custom.message.something_went_wrong'),
                'error' => $exception->getMessage()
            ]);
        }
    }

    public function showFormForgotPassword()
    {
        return view('website.pages.forgot-password');
    }

    public function sendLinkResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
        ], [
            'required' => ':attribute là trường bắt buộc',
            'email' => ':attribute chưa đúng định dạng email',
            'max' => ':attribute chỉ được tối đa :max ký tự',
        ], [
            'email' => 'Email'
        ]);

        try {
            /** @var Student $student */
            if (!$student = Student::firstByEmail($request->get('email'))) {
                return back()
                    ->withErrors(['email' => 'Email không tồn tại trong hệ thống.'])
                    ->withInput();
            }

            $student->forgotPassword();

            return back()
                ->with('successMsg', 'Yêu cầu đổi mật khẩu đã được gửi tới email của bạn.');
        } catch (Throwable $exception) {
            return back()
                ->withErrors(['email' => __('custom.message.something_went_wrong')])
                ->withInput();
        }
    }

    public function showFormResetPassword($token)
    {
        $student = Student::firstByResetPasswordToken($token);

        return view('website.pages.reset-password', compact('student', 'token'));
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|string|max:40|min:6|confirmed',
        ], [
            'required' => ':attribute là trường bắt buộc',
            'max' => ':attribute chỉ được tối đa :max ký tự',
            'min' => ':attribute phải có tối thiểu :min ký tự',
            'confirmed' => 'Xác nhận mật khẩu không giống với mật khẩu',
        ], [
            'password' => 'Mật khẩu',
        ]);

        try {
            /** @var Student $student */
            if (!$student = Student::firstByResetPasswordToken($token)) {
                return back()
                    ->withErrors(['password' => 'Yêu cầu đổi mật khẩu không tồn tại hoặc đã hết hạn.'])
                    ->withInput();
            }

            $student->resetPassword($request->get('password'));

            return back()
                ->with('successMsg', 'Khôi phục mật khẩu thành công.');
        } catch (Throwable $exception) {
            return back()
                ->withErrors(['password' => __('custom.message.something_went_wrong')])
                ->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class LoginController extends Controller
{
    private $guard;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->guard = Auth::guard(config('project.auth_guard.admin'));
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50',
        ]);

        try {
            if (!$this->guard->attempt($request->only('email', 'password'))) {
                return back()
                    ->withErrors(['email' => 'Tài khoản hoặc mật khẩu không chính xác. Vui lòng thử lại!'])
                    ->withInput();
            }

            return redirect()->route('admin.home');
        } catch (Throwable $exception) {
            return back()
                ->withErrors(['email' => $exception->getMessage()])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.show_form_login');
    }
}

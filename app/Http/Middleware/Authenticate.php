<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Str::startsWith($request->route()->getName(), 'admin.')) {
                return route('admin.show_form_login');
            } else {
                return route('website.home');
            }
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        // Danh sách các route không cần login vẫn có thể sử dụng
        // nhưng vẫn được bọc mởi middleware "auth" vì cần sử dụng
        // chức năng logoutOtherDevices khi login.
        $ignoreRouteNames = ['website.home', 'website.course.show'];

        if (!in_array($request->route()->getName(), $ignoreRouteNames)) {
            throw new AuthenticationException(
                'Unauthenticated.', $guards, $this->redirectTo($request)
            );
        }
    }
}

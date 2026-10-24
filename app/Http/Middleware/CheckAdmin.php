<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra người dùng đã đăng nhập và có role_id = 1 (Admin) chưa
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Bạn không có quyền truy cập trang quản trị!');
    }
}
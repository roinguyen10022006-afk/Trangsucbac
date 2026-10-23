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
        // Kiểm tra xem user đã đăng nhập và có role_id = 1 (Admin) hay không
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Bạn không có quyền truy cập vào trang quản trị Admin!');
    }
}
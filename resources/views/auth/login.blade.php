@extends('layouts.client')

@section('title', 'Đăng Nhập - Silver Luxe')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-gem fs-1 text-dark"></i>
                    <h4 class="fw-bold text-uppercase mt-2">Đăng Nhập</h4>
                    <p class="text-muted small">Chào mừng bạn quay trở lại với Silver Luxe</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger rounded-3 small">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Địa chỉ Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-pill" placeholder="name@example.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Mật khẩu</label>
                        <input type="password" name="password" class="form-control rounded-pill" placeholder="••••••••" required>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Ghi nhớ đăng nhập</label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm">Đăng Nhập</button>
                </form>

                <div class="text-center mt-4 small">
                    <span class="text-muted">Chưa có tài khoản?</span>
                    <a href="{{ route('register') }}" class="text-dark fw-bold text-decoration-none">Đăng ký ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
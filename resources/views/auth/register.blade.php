@extends('layouts.client')

@section('title', 'Đăng Ký Tài Khoản - Silver Luxe')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-gem fs-1 text-dark"></i>
                    <h4 class="fw-bold text-uppercase mt-2">Đăng Ký Tài Khoản</h4>
                    <p class="text-muted small">Tạo tài khoản để trải nghiệm mua sắm tốt nhất</p>
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

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control rounded-pill" placeholder="Nguyễn Văn A" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Địa chỉ Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control rounded-pill" placeholder="name@example.com" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Mật khẩu</label>
                            <input type="password" name="password" class="form-control rounded-pill" placeholder="Ít nhất 6 ký tự" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control rounded-pill" placeholder="Nhập lại mật khẩu" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control rounded-pill" placeholder="0901234567">
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Địa chỉ giao hàng</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control rounded-pill" placeholder="Số nhà, Tên đường, TP.HCM">
                    </div>

                    <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-semibold shadow-sm">Đăng Ký Ngay</button>
                </form>

                <div class="text-center mt-4 small">
                    <span class="text-muted">Đã có tài khoản?</span>
                    <a href="{{ route('login') }}" class="text-dark fw-bold text-decoration-none">Đăng nhập</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
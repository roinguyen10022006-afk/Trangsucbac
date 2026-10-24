@extends('layouts.admin')

@section('content')
<div class="container py-4">
    {{-- Banner chào mừng --}}
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
        <div class="container-fluid py-2">
            <h1 class="display-5 fw-bold text-primary">Trang Quản Trị Silver Luxe</h1>
            <p class="col-md-8 fs-5 text-muted">Chào mừng Admin đã đăng nhập thành công vào hệ thống quản lý trang sức bạc!</p>
        </div>
    </div>

    {{-- Lối truy cập nhanh các chức năng --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold">Quản Lý Danh Mục</h5>
                    <p class="card-text opacity-75">Quản lý phân loại trang sức (Nhẫn, Dây chuyền, Bông tai, Lắc tay...).</p>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light fw-bold text-primary">Đi tới Quản lý Danh mục ➔</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold">Quản Lý Sản Phẩm</h5>
                    <p class="card-text opacity-75">Quản lý kho hàng, giá bán, độ tinh khiết bạc và upload hình ảnh sản phẩm.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light fw-bold text-success">Đi tới Quản lý Sản phẩm ➔</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
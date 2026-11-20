@extends('layouts.client')

@section('content')
<style>
    .category-header-banner {
        background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        color: #ffffff;
        border-radius: 16px;
    }
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }
    .product-img-box {
        height: 230px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .product-img-box img {
        max-height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .product-card:hover .product-img-box img {
        transform: scale(1.08);
    }
</style>

<div class="container py-4">
    <!-- 1. Thanh điều hướng Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-secondary">Trang chủ</a></li>
            <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $categoryName ?? 'Danh Mục Trang Sức' }}</li>
        </ol>
    </nav>

   
<!-- 2. BANNER TỰ ĐỘNG ĐỔI THEO DANH MỤC -->
<div class="mb-4">
    <img src="{{ asset('images/banner-' . ($slug ?? 'default') . '.jpg') }}" 
         alt="{{ $categoryName ?? 'Danh Mục Trang Sức' }}" 
         class="img-fluid w-100 rounded-4 shadow" 
         style="max-height: 340px; min-height: 200px; object-fit: cover;"
         onerror="this.src='[suspicious link removed]'">
</div>

    <!-- 3. Thanh Lọc & Sắp Xếp Sản Phẩm (Tự động lọc khi chọn) -->
<form method="GET" action="{{ url()->current() }}" class="d-flex justify-content-between align-items-center bg-white p-3 rounded-3 border mb-4 shadow-sm">
    <!-- LỌC THEO MỨC GIÁ -->
    <div class="d-flex align-items-center gap-2">
        <span class="fw-bold small text-uppercase text-muted">Bộ lọc:</span>
        <select name="price_range" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
            <option value="">Tất cả mức giá</option>
            <option value="under-500" {{ request('price_range') == 'under-500' ? 'selected' : '' }}>Dưới 500,000 đ</option>
            <option value="500-1000" {{ request('price_range') == '500-1000' ? 'selected' : '' }}>500,000 - 1,000,000 đ</option>
            <option value="over-1000" {{ request('price_range') == 'over-1000' ? 'selected' : '' }}>Trên 1,000,000 đ</option>
        </select>
    </div>

    <!-- SẮP XẾP SẢN PHẨM -->
    <div class="d-flex align-items-center gap-2">
        <span class="fw-bold small text-uppercase text-muted">Sắp xếp:</span>
        <select name="sort" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
            <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Mới nhất</option>
            <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
            <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
        </select>
    </div>
</form>

   <!-- 4. Lưới Sản Phẩm Danh Mục (4 Cột - Đã sửa ảnh tràn khung 100%) -->
<div class="row g-4 mb-4">
    @forelse($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card h-100 d-flex flex-column border rounded-3 overflow-hidden shadow-sm bg-white">
                
                <!-- 🟢 CỤM ẢNH SẢN PHẨM (ĐÃ SỬA TRÀN KHUNG) -->
                <div class="product-img-box position-relative overflow-hidden">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark text-white" style="z-index: 2;">Bạc 925</span>
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid w-100 d-block"
                         style="height: 240px; object-fit: cover;"
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=500&auto=format&fit=crop';">
                </div>

                <div class="p-3 d-flex flex-column flex-grow-1">
                    <small class="text-muted mb-1">{{ $categoryName }}</small>
                    <h6 class="fw-bold text-dark text-truncate mb-2" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h6>

                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-danger fw-bold fs-5">{{ number_format($product->price) }} đ</span>
                            <small class="text-muted">Còn {{ $product->stock_quantity ?? 10 }}</small>
                        </div>
                        <div class="d-grid">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-dark btn-sm rounded-pill fw-bold">
                                Xem Chi Tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5 bg-white rounded-3 border">
            <p class="text-muted mb-0">Chưa có sản phẩm nào trong danh mục <strong>{{ $categoryName }}</strong>.</p>
        </div>
    @endforelse
</div>

    <!-- 5. Phân Trang (Nút chuyển trang 1, 2, 3...) -->
    @if(method_exists($products, 'links'))
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
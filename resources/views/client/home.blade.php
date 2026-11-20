@extends('layouts.client')

@section('content')
<!-- CUSTOM CSS HOVER & LUXURY STYLING -->
<style>
    .hero-banner {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: #ffffff;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
    }

    .badge-silver {
        background: linear-gradient(45deg, #e2e8f0, #cbd5e1);
        color: #1e293b;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .category-card {
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
        border-radius: 16px;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: #cbd5e1;
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
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
    }

    .product-img-box {
        position: relative;
        overflow: hidden;
        background-color: #f8fafc;
        height: 240px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img-box img {
        max-height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-img-box img {
        transform: scale(1.08);
    }

    .btn-silver-primary {
        background: #1e293b;
        color: #ffffff;
        border-radius: 30px;
        font-weight: 600;
        padding: 10px 24px;
        transition: all 0.3s ease;
    }

    .btn-silver-primary:hover {
        background: #334155;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(30, 41, 59, 0.25);
    }

    .feature-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 12px auto;
        color: #334155;
    }
</style>

<div class="container py-4">

    <!-- 1. HERO BANNER SANG TRỌNG -->
    <div class="hero-banner p-5 mb-5 shadow-lg">
        <div class="row align-items-center position-relative" style="z-index: 2;">
            <div class="col-lg-7 mb-4 mb-lg-0">
                <span class="badge badge-silver px-3 py-2 rounded-pill text-uppercase mb-3">
                    ✨ Bộ Sưu Tập Bạc S925 Thủ Công
                </span>
                <h1 class="display-4 fw-bold mb-3">Tỏa Sáng Vẻ Đẹp Tinh Tế Cùng Silver Luxe</h1>
                <p class="lead text-light opacity-75 mb-4">
                    Khám phá hàng trăm mẫu nhẫn, dây chuyền và vòng tay bạc cao cấp. Chế tác tỉ mỉ, độ sáng bền lâu và an toàn tuyệt đối cho làn da.
                </p>
                <div class="d-flex gap-3">
                    <a href="#featured-products" class="btn btn-silver-primary">Khám Phá Ngay</a>
                    <a href="{{ route('home') }}" class="btn btn-outline-light rounded-pill px-4 fw-bold">Xem Danh Mục</a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <div class="p-3 bg-white bg-opacity-10 rounded-4 backdrop-blur border border-white border-opacity-20 shadow">
                    <img src="{{ asset('images/hero-banner.jpg') }}"
                        alt="Silver Luxe Jewelry"
                        class="img-fluid rounded-3 shadow">
                </div>
            </div>
        </div>
    </div>

    <!-- 2. THANH CAM KẾT VÀ GIÁ TRỊ THƯƠNG HIỆU -->
    <div class="row text-center g-4 mb-5">
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded-4 bg-white shadow-sm h-100">
                <div class="feature-icon-box">💎</div>
                <h6 class="fw-bold mb-1">Bạc S925 Chuẩn</h6>
                <small class="text-muted">Cam kết bạc 92.5% sáng bóng cao cấp</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded-4 bg-white shadow-sm h-100">
                <div class="feature-icon-box">🚚</div>
                <h6 class="fw-bold mb-1">Giao Hàng Toàn Quốc</h6>
                <small class="text-muted">Kiểm tra hàng trước khi thanh toán</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded-4 bg-white shadow-sm h-100">
                <div class="feature-icon-box">🎁</div>
                <h6 class="fw-bold mb-1">Hộp Quà Sang Trọng</h6>
                <small class="text-muted">Tặng kèm khăn lau bạc chuyên dụng</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="p-3 border rounded-4 bg-white shadow-sm h-100">
                <div class="feature-icon-box">🔄</div>
                <h6 class="fw-bold mb-1">Đổi Trả 7 Ngày</h6>
                <small class="text-muted">Bảo hành làm sáng miễn phí trọn đời</small>
            </div>
        </div>
    </div>

    <!-- 3. DANH MỤC SẢN PHẨM NỔI BẬT -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Danh Mục Trang Sức</h3>
                <p class="text-muted mb-0">Tìm kiếm món trang sức yêu thích theo phong cách của bạn</p>
            </div>
        </div>
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3">
                <div class="category-card p-4 bg-white">
                    <div class="fs-1 mb-2">💍</div>
                    <h6 class="fw-bold">Nhẫn Bạc S925</h6>
                    <small class="text-muted">Nhẫn đôi, nhẫn nữ đá quý</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 bg-white">
                    <div class="fs-1 mb-2">📿</div>
                    <h6 class="fw-bold">Dây Chuyền Bạc</h6>
                    <small class="text-muted">Mặt trái tim, cỏ 4 lá</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 bg-white">
                    <div class="fs-1 mb-2">✨</div>
                    <h6 class="fw-bold">Bông Tai Bạc</h6>
                    <small class="text-muted">Nụ nơ, bông đính đá</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="category-card p-4 bg-white">
                    <div class="fs-1 mb-2">💫</div>
                    <h6 class="fw-bold">Vòng & Lắc Tay</h6>
                    <small class="text-muted">Lắc charm, vòng trơn</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. DANH SÁCH SẢN PHẨM TRANG CHỦ ($products từ Controller) -->
<div id="featured-products" class="mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <span class="text-uppercase text-primary fw-bold small">Bộ Sưu Tập Mới</span>
            <h3 class="fw-bold mb-0">Sản Phẩm Nổi Bật</h3>
        </div>
        <span class="badge bg-secondary px-3 py-2 rounded-pill">Top {{ $products->count() }} Chọn Lọc</span>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="product-card h-100 d-flex flex-column border rounded-3 overflow-hidden shadow-sm bg-white">
                
                <!-- 🟢 KHỐI ẢNH SẢN PHẨM (ĐÃ SỬA TRÀN KHUNG & CHUẨN KÍCH THƯỚC) -->
                <div class="product-img-box position-relative overflow-hidden">
                    <span class="position-absolute top-0 start-0 m-2 badge bg-dark shadow-sm" style="z-index: 2;">Bạc 925</span>
                    <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="img-fluid w-100"
                        style="height: 240px; object-fit: cover;"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=500&auto=format&fit=crop';">
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <small class="text-muted mb-1">Trang Sức Bạc</small>
                    <h6 class="fw-bold text-dark text-truncate mb-2" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h6>

                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-danger fw-bold fs-5">
                                {{ number_format($product->price) }} đ
                            </span>
                            <small class="text-success fw-bold">Còn {{ $product->stock_quantity ?? 10 }}</small>
                        </div>

                        <!-- Thao tác -->
                        <div class="d-grid gap-2">
                            <a href="{{ route('products.show', $product->id ?? 1) }}"
                                class="btn btn-outline-dark btn-sm rounded-pill fw-bold">
                                Xem Chi Tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Đang cập nhật danh sách sản phẩm nổi bật...</p>
        </div>
        @endforelse
    </div>
</div>

    <!-- 5. BANNER KHUYẾN MÃI & CÂU CHUYỆN THƯƠNG HIỆU -->
    <div class="bg-light p-4 p-md-5 rounded-4 border mb-5">
        <div class="row align-items-center">
            <div class="col-md-7 mb-3 mb-md-0">
                <h4 class="fw-bold mb-2">🎁 Nhận Ngay Voucher 10% Cho Đơn Hàng Đầu Tiên</h4>
                <p class="text-muted mb-0">Đăng ký tài khoản thành viên Silver Luxe để nhận ưu đãi đặc quyền và chính sách làm sáng trang sức miễn phí trọn đời.</p>
            </div>
            <div class="col-md-5 text-md-end">
                <a href="{{ route('register') }}" class="btn btn-silver-primary">Đăng Ký Thành Viên</a>
            </div>
        </div>
    </div>

</div>
@endsection
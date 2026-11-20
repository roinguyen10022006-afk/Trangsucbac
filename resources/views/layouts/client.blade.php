<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Silver Luxe - Trang Sức Bạc S925')</title>

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #2b2b2b;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .btn-luxury {
            background: linear-gradient(135deg, #1a1a1a 0%, #3a3a3a 100%);
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-luxury:hover {
            background: linear-gradient(135deg, #3a3a3a 0%, #1a1a1a 100%);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .badge-silver {
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #ced4da;
        }

        #searchResults {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: none;
        }

        /* 1. Hiệu ứng phóng to ảnh sản phẩm khi rê chuột */
        .product-img-holder {
            position: relative;
            overflow: hidden;
            /* Giữ ảnh không bị tràn ra ngoài khung */
            border-radius: 12px;
            /* Bo góc ảnh mượt mà */
        }

        .product-img-holder img {
            object-fit: cover;
            transition: transform 0.4s ease-in-out;
            /* Chuyển động mượt 0.4s */
        }

        .product-card-premium:hover .product-img-holder img {
            transform: scale(1.1);
            /* Phóng to ảnh 10% khi rê chuột vào thẻ */
        }

        /* 2. Hiệu ứng trượt nút "Thêm Nhanh" khi rê chuột */
        .quick-action-btns {
            position: absolute;
            bottom: 10px;
            left: 10px;
            right: 10px;
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.3s ease;
            z-index: 2;
        }

        .product-card-premium:hover .quick-action-btns {
            opacity: 1;
            transform: translateY(0);
            /* Trượt nhẹ nút Thêm Nhanh lên */
        }

        /* 3. Hiệu ứng nổi bóng nhẹ cho toàn bộ thẻ sản phẩm */
        .product-card-premium {
            border: 1px solid #f0f0f0;
            border-radius: 16px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .product-card-premium:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
            transform: translateY(-4px);
            /* Nổi nhẹ thẻ lên 4px */
        }
    </style>
</head>

<body>

    <header class="bg-white sticky-top shadow-sm border-bottom">
        <nav class="navbar navbar-expand-lg container py-3">
            <!-- 1. Logo Thương Hiệu -->
            <a class="navbar-brand fs-3 fw-bold text-dark me-4" href="{{ route('home') }}">
                <i class="bi bi-gem text-secondary me-2"></i>SILVER LUXE
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <!-- 2. Thanh Menu Danh Mục (Đã thêm d-flex justify-content-evenly w-100 để GIÃN CÁCH ĐỀU) -->
               <!-- Thanh Menu Danh Mục 5 Trang Chuẩn -->
<ul class="navbar-nav mx-lg-4 me-auto mb-2 mb-lg-0 d-flex justify-content-evenly w-100">
    <!-- TRANG CHỦ -->
    <li class="nav-item">
        <a class="nav-link text-dark {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }} px-3" 
           href="{{ route('home') }}" 
           style="font-size: 1.15rem; font-weight: 700; white-space: nowrap;">
           Trang Chủ
        </a>
    </li>

    <!-- NHẪN BẠC -->
    <li class="nav-item">
        <a class="nav-link text-dark {{ request()->is('category/nhan-bac') ? 'active text-primary fw-bold' : '' }} px-3" 
           href="{{ route('category.show', 'nhan-bac') }}" 
           style="font-size: 1.15rem; font-weight: 700; white-space: nowrap;">
           Nhẫn Bạc
        </a>
    </li>

    <!-- DÂY CHUYỀN -->
    <li class="nav-item">
        <a class="nav-link text-dark {{ request()->is('category/day-chuyen') ? 'active text-primary fw-bold' : '' }} px-3" 
           href="{{ route('category.show', 'day-chuyen') }}" 
           style="font-size: 1.15rem; font-weight: 700; white-space: nowrap;">
           Dây Chuyền
        </a>
    </li>

    <!-- BÔNG TAI -->
    <li class="nav-item">
        <a class="nav-link text-dark {{ request()->is('category/bong-tai') ? 'active text-primary fw-bold' : '' }} px-3" 
           href="{{ route('category.show', 'bong-tai') }}" 
           style="font-size: 1.15rem; font-weight: 700; white-space: nowrap;">
           Bông Tai
        </a>
    </li>

    <!-- VÒNG LẮC (Đã sửa từ 'vòng-tay' -> 'vong-tay') -->
    <li class="nav-item">
        <a class="nav-link text-dark {{ request()->is('category/vong-tay') ? 'active text-primary fw-bold' : '' }} px-3" 
           href="{{ route('category.show', 'vong-tay') }}" 
           style="font-size: 1.15rem; font-weight: 700; white-space: nowrap;">
           Vòng Lắc
        </a>
    </li>
</ul>

                <!-- 3. Ô Tìm Kiếm AJAX -->
                <div class="position-relative me-lg-3 mb-2 mb-lg-0 ms-auto" style="max-width: 240px; min-width: 200px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control bg-light border-start-0 rounded-end-pill pe-3 form-control-sm py-2" placeholder="Tìm trang sức...">
                    </div>
                    <div id="searchResults" class="p-2 mt-1"></div>
                </div>

                <!-- 4. Giỏ Hàng & Tài Khoản -->
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark rounded-pill px-3 position-relative btn-sm py-2">
                        <i class="bi bi-bag fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>

                    @auth
                    <div class="dropdown">
                        <button class="btn btn-dark rounded-pill px-3 py-2 btn-sm dropdown-toggle fs-6 fw-semibold" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end rounded-3 shadow border-0 mt-2">
                            @if(Auth::user()->role_id == 1)
                            <li><a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2 text-primary"></i>Trang Admin</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @endif
                            <li><a class="dropdown-item py-2" href="{{ route('orders.history') }}"><i class="bi bi-clock-history me-2 text-success"></i>Đơn hàng của tôi</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-3 py-2 btn-sm fs-6 fw-semibold">Đăng Nhập</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- 2. THÔNG BÁO FLASH MESSAGES -->
    <div class="container mt-3">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
    </div>

    <!-- 3. NỘI DUNG THAY ĐỔI TỪNG TRANG -->
    <main>
        @yield('content')
    </main>

    <!-- 4. FOOTER (CHÂN TRANG) -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5 border-top border-secondary">
        <div class="container">
            <div class="row g-4 text-start">
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold text-uppercase mb-3"><i class="bi bi-gem me-2 text-secondary"></i>Silver Luxe</h5>
                    <p class="text-secondary small">
                        Thương hiệu trang sức bạc S925 cao cấp. Thiết kế tinh xảo, hiện đại và tôn vinh vẻ đẹp sang trọng của bạn.
                    </p>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-light">Sản Phẩm</h6>
                    <ul class="list-unstyled text-secondary small mb-0">
                        <li class="mb-2">Nhẫn Bạc Ý S925</li>
                        <li class="mb-2">Dây Chuyền Bạc</li>
                        <li class="mb-2">Bông Tai Bạc</li>
                        <li class="mb-2">Vòng Tay & Lắc</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-light">Chính Sách & Hỗ Trợ</h6>
                    <ul class="list-unstyled text-secondary small mb-0">
                        <li class="mb-2"><i class="bi bi-shield-check me-2 text-warning"></i>Bảo hành làm sáng bạc</li>
                        <li class="mb-2"><i class="bi bi-arrow-counterclockwise me-2 text-info"></i>Đổi trả trong 30 ngày</li>
                        <li class="mb-2"><i class="bi bi-truck me-2 text-success"></i>Giao hàng toàn quốc</li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-uppercase mb-3 text-light">Liên Hệ</h6>
                    <ul class="list-unstyled text-secondary small mb-0">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2 text-danger"></i>TP. Hồ Chí Minh</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2 text-success"></i>0901 234 567</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2 text-warning"></i>support@silverluxe.vn</li>
                    </ul>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-secondary">
                <p class="mb-0">&copy; {{ date('Y') }} Silver Luxe. Tất cả quyền được bảo lưu.</p>
                <p class="mb-0">Đồ án môn Lập trình Mã nguồn mở</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Tìm kiếm Realtime AJAX -->
    <script>
        document.getElementById('searchInput')?.addEventListener('input', function() {
            let keyword = this.value.trim();
            let resultsBox = document.getElementById('searchResults');

            if (keyword.length > 1) {
                fetch(`{{ route('ajax.search') }}?keyword=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsBox.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                resultsBox.innerHTML += `
                                    <a href="/products/${item.id}" class="d-flex align-items-center gap-3 p-2 text-decoration-none text-dark border-bottom">
                                        <img src="${item.image ? '/storage/' + item.image : 'https://images.unsplash.com/photo-1603561591411-07134e71a2a9?q=80&w=600'}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold small">${item.name}</div>
                                            <div class="text-danger small fw-semibold">${Number(item.price).toLocaleString()} đ</div>
                                        </div>
                                    </a>
                                `;
                            });
                            resultsBox.style.display = 'block';
                        } else {
                            resultsBox.innerHTML = '<div class="p-3 text-muted small text-center">Không tìm thấy sản phẩm phù hợp</div>';
                            resultsBox.style.display = 'block';
                        }
                    });
            } else {
                resultsBox.style.display = 'none';
            }
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('#searchInput') && !e.target.closest('#searchResults')) {
                document.getElementById('searchResults').style.display = 'none';
            }
        });
    </script>
</body>

</html>
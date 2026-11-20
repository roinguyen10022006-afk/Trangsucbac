@extends('layouts.client')
@section('title', $product->name . ' - Silver Luxe')

@section('content')
<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-secondary">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- 1. KHỐI CHI TIẾT SẢN PHẨM -->
    <div class="row g-5 align-items-start mb-5">
        
        <!-- KHỐI HÌNH ẢNH SẢN PHẨM TRANG CHI TIẾT -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card border-0 shadow-sm p-0 rounded-4 bg-white overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid w-100" 
                     style="height: 420px; object-fit: cover;"
                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600&auto=format&fit=crop';">
            </div>
        </div>

        <!-- Thông Tin Chi Tiết -->
        <div class="col-md-6">
            <span class="badge badge-silver mb-2 px-3 py-2 rounded-pill">{{ $product->purity ?? 'Bạc S925' }}</span>
            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>
            <h3 class="text-danger fw-bold mb-4">{{ number_format($product->price) }} đ</h3>

            <p class="text-muted mb-4">
                {{ $product->description ?? 'Sản phẩm trang sức bạc cao cấp được chế tác thủ công tinh xảo, sáng bóng bền màu và an toàn cho da.' }}
            </p>

            <ul class="list-unstyled mb-4">
                <li class="mb-2"><i class="bi bi-shield-check text-success me-2"></i>Chất liệu: <strong>{{ $product->purity ?? 'Bạc S925 Ý' }}</strong></li>
                <li class="mb-2"><i class="bi bi-box-seam text-primary me-2"></i>Tình trạng: 
                    @if(($product->stock_quantity ?? 10) > 0)
                        <span class="badge bg-success">Còn hàng ({{ $product->stock_quantity ?? 10 }})</span>
                    @else
                        <span class="badge bg-secondary">Hết hàng</span>
                    @endif
                </li>
                <li><i class="bi bi-truck text-warning me-2"></i>Giao hàng toàn quốc - Kiểm tra hàng trước khi thanh toán</li>
            </ul>

            <!-- Form Thêm Giỏ Hàng -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-flex align-items-center gap-3">
                @csrf
                <div class="input-group" style="width: 130px;">
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock_quantity ?? 99 }}" class="form-control text-center rounded-pill">
                </div>
                <button type="submit" class="btn btn-luxury px-4 py-2 flex-grow-1">
                    <i class="bi bi-bag-plus me-2"></i> Thêm Vào Giỏ Hàng
                </button>
            </form>
        </div>
    </div>

    <!-- 2. KHỐI ĐÁNH GIÁ & BÌNH LUẬN (ĐÃ TÍCH HỢP ĐỘC LẬP BÊN DƯỚI) -->
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mt-4">
        <h4 class="fw-bold mb-4">Đánh Giá & Bình Luận Sản Phẩm</h4>

        <!-- Thống kê Sao trung bình -->
        <div class="row align-items-center mb-4 p-3 bg-light rounded-3">
            <div class="col-md-4 text-center border-end mb-3 mb-md-0">
                <h1 class="fw-bold text-warning display-4 mb-0">{{ method_exists($product, 'averageRating') ? $product->averageRating() : '5.0' }}</h1>
                <div class="text-warning fs-5 mb-1">
                    @php $avgRating = method_exists($product, 'averageRating') ? round($product->averageRating()) : 5; @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa{{ $i <= $avgRating ? 's' : 'r' }} fa-star"></i>
                    @endfor
                </div>
                <small class="text-muted">Dựa trên {{ $product->reviews->count() ?? 0 }} đánh giá</small>
            </div>

            <div class="col-md-8">
                <h6 class="fw-bold mb-2">Gửi đánh giá của bạn</h6>

                <!-- Form Gửi Đánh Giá -->
                <form action="{{ route('reviews.store', $product->id) }}" method="POST">
                    @csrf
                    
                    <!-- Chọn 1 - 5 Sao -->
                    <div class="mb-3">
                        <label class="form-label fw-bold me-3">Đánh giá số sao:</label>
                        <div class="star-rating d-inline-flex flex-row-reverse">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 sao"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 sao"><i class="fas fa-star"></i></label>
                        </div>
                        @error('rating')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    @guest
                    <div class="mb-3">
                        <input type="text" name="user_name" class="form-control" placeholder="Họ và tên của bạn (không bắt buộc)">
                    </div>
                    @endguest

                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Chia sẻ cảm nhận của bạn về chất lượng trang sức bạc S925, độ sáng bóng, chế tác..." required></textarea>
                        @error('comment')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">
                        <i class="fas fa-paper-plane me-2"></i>Gửi Đánh Giá
                    </button>
                </form>
            </div>
        </div>

        <hr class="my-4">

        <!-- Danh sách các bình luận đã gửi -->
        <h5 class="fw-bold mb-3">Tất cả đánh giá ({{ $product->reviews->count() ?? 0 }})</h5>
        <div class="review-list">
            @forelse($product->reviews ?? [] as $review)
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-dark rounded-circle p-2" style="width:35px; height:35px; display:inline-flex; align-items:center; justify-content:center;">
                                {{ strtoupper(substr($review->user_name ?? ($review->user->name ?? 'K'), 0, 1)) }}
                            </span>
                            <div>
                                <strong class="d-block text-dark">{{ $review->user_name ?? ($review->user->name ?? 'Khách hàng') }}</strong>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="text-warning small">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star"></i>
                            @endfor
                        </div>
                    </div>
                    <p class="text-dark mb-0 ms-5 ps-2">{{ $review->comment }}</p>
                </div>
            @empty
                <p class="text-muted text-center py-4">Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên trải nghiệm và gửi đánh giá nhé!</p>
            @endforelse
        </div>
    </div>

</div>

<!-- CSS cho bộ chọn sao tương tác -->
<style>
.star-rating {
    direction: rtl;
    font-size: 1.5rem;
}
.star-rating input[type="radio"] {
    display: none;
}
.star-rating label {
    color: #ccc;
    cursor: pointer;
    padding: 0 0.15rem;
    transition: color 0.2s ease-in-out;
}
.star-rating input[type="radio"]:checked ~ label,
.star-rating label:hover,
.star-rating label:hover ~ label {
    color: #ffc107;
}
</style>
@endsection
@extends('layouts.client')
@section('title', 'Giỏ Hàng - Silver Luxe')

@section('content')
<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-bag me-2"></i>Giỏ Hàng Của Bạn</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row g-4">
            <!-- Danh sách sản phẩm trong giỏ -->
            <div class="col-lg-8">
                <div class="table-responsive bg-white rounded-4 shadow-sm border p-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Đơn giá</th>
                                <th class="text-center" style="width: 120px;">Số lượng</th>
                                <th class="text-end">Thành tiền</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : '[suspicious link removed]' }}" 
                                                 alt="{{ $details['name'] }}" 
                                                 class="rounded-3" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-0 text-truncate" style="max-width: 200px;">{{ $details['name'] }}</h6>
                                                <span class="badge badge-silver mt-1">Bạc S925</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center fw-semibold">{{ number_format($details['price']) }} đ</td>
                                    <td class="text-center">
                                        <input type="number" value="{{ $details['quantity'] }}" min="1" class="form-control form-control-sm text-center mx-auto" style="width: 70px;" readonly>
                                    </td>
                                    <td class="text-end text-danger fw-bold">{{ number_format($subtotal) }} đ</td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Xóa">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng & Cột thanh toán -->
            <div class="col-lg-4">
                <div class="bg-white rounded-4 shadow-sm border p-4">
                    <h5 class="fw-bold mb-3">Tóm Tắt Đơn Hàng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính:</span>
                        <span class="fw-semibold">{{ number_format($total) }} đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Vận chuyển:</span>
                        <span class="text-success fw-semibold">Miễn phí toàn quốc</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Tổng thanh toán:</span>
                        <span class="text-danger fw-bold fs-5">{{ number_format($total) }} đ</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-luxury w-100 py-2 rounded-pill fw-bold mb-2">
                        <i class="bi bi-credit-card me-2"></i> Tiến Hành Thanh Toán
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-semibold">
                        <i class="bi bi-arrow-left me-2"></i> Tiếp Tục Mua Sắm
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Trạng thái Giỏ hàng trống -->
        <div class="text-center py-5 bg-white rounded-4 border shadow-sm">
            <i class="bi bi-bag-x display-1 text-muted"></i>
            <h4 class="fw-bold mt-3">Giỏ hàng của bạn đang trống!</h4>
            <p class="text-muted mb-4">Hãy chọn món trang sức bạc ưng ý để thêm vào giỏ hàng nhé.</p>
            <a href="{{ route('home') }}" class="btn btn-luxury px-5 py-2 rounded-pill fw-bold">
                Khám Phá Sản Phẩm Ngay
            </a>
        </div>
    @endif
</div>
@endsection
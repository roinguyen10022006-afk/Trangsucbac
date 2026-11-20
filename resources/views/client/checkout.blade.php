@extends('layouts.client')
@section('title', 'Thanh Toán Đơn Hàng - Silver Luxe')

@section('content')
<div class="container my-5">
    <h3 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>Thanh Toán Đơn Hàng</h3>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row g-4">
            <!-- Thông tin giao hàng -->
            <div class="col-lg-7">
                <div class="bg-white rounded-4 shadow-sm border p-4">
                    <h5 class="fw-bold mb-4 text-primary"><i class="bi bi-geo-alt me-2"></i>Thông Tin Giao Hàng</h5>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Họ và tên người nhận <span class="text-danger">*</span></label>
                        <input type="text" name="receiver_name" value="{{ Auth::user()->name ?? '' }}" class="form-control rounded-3" placeholder="Nhập họ và tên đầy đủ" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Số điện thoại nhận hàng <span class="text-danger">*</span></label>
                        <input type="text" name="receiver_phone" value="{{ Auth::user()->phone ?? '' }}" class="form-control rounded-3" placeholder="Nhập số điện thoại" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Địa chỉ giao hàng chi tiết <span class="text-danger">*</span></label>
                        <textarea name="shipping_address" class="form-control rounded-3" rows="3" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố..." required>{{ Auth::user()->address ?? '' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ghi chú đơn hàng (không bắt buộc)</label>
                        <textarea name="note" class="form-control rounded-3" rows="2" placeholder="Ghi chú thêm về thời gian giao hàng, chỉ đường..."></textarea>
                    </div>

                    <!-- PHƯƠNG THỨC THANH TOÁN -->
<div class="payment-methods mt-4">
    <h5 class="fw-bold mb-3">Phương thức thanh toán</h5>

    <!-- Option 1: COD -->
    <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
        <label class="form-check-label fw-bold" for="payment_cod">
            💵 Thanh toán khi nhận hàng (COD)
        </label>
    </div>

    <!-- Option 2: Chuyển khoản QR -->
    <div class="form-check mb-3">
        <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="bank_transfer">
        <label class="form-check-label fw-bold" for="payment_bank">
            🏦 Chuyển khoản ngân hàng (Mã QR)
        </label>
    </div>

    <!-- KHUNG HIỂN THỊ MÃ QR (Mặc định ẩn với class d-none) -->
    <div id="qr-code-box" class="card card-body bg-light text-center border-primary mt-3 d-none">
        <h6 class="text-primary fw-bold">QUÉT MÃ QR ĐỂ THANH TOÁN</h6>
        <p class="small text-muted mb-2">Sử dụng App Ngân hàng hoặc Quét mã để chuyển khoản chính xác số tiền</p>

        <!-- Ảnh Mã QR (Dùng API VietQR tự động tạo theo số tiền $total) -->
        <div class="my-2">
            <img src="[suspicious link removed]{{ $total ?? 0 }}&addInfo=Thanh%20toan%20don%20hang&accountName=SILVER%20LUXE" 
                 alt="Mã QR Chuyển Khoản" 
                 class="img-fluid rounded border shadow-sm" 
                 style="max-width: 240px;">
        </div>

        <div class="text-start bg-white p-3 rounded border small mt-2">
            <p class="mb-1"><strong>Ngân hàng:</strong> MB Bank (Quân Đội)</p>
            <p class="mb-1"><strong>Số tài khoản:</strong> <code>0987654321</code></p>
            <p class="mb-1"><strong>Chủ tài khoản:</strong> SILVER LUXE JEWELRY</p>
            <p class="mb-0"><strong>Nội dung CK:</strong> <span class="text-danger fw-bold">CHUYEN KHOAN MUA HANG</span></p>
        </div>
    </div>
</div>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-lg-5">
                <div class="bg-white rounded-4 shadow-sm border p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-bag-check me-2"></i>Sản Phẩm Đặt Mua</h5>
                    
                    @php $total = 0; @endphp
                    @if(session('cart'))
                        <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                            @foreach(session('cart') as $id => $details)
                                @php 
                                    $subtotal = $details['price'] * $details['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                    <img src="{{ $details['image'] ? asset('storage/' . $details['image']) : 'https://images.unsplash.com/photo-1603561591411-07134e71a2a9?q=80&w=600' }}" 
                                         alt="{{ $details['name'] }}" class="rounded-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-0 text-truncate" style="max-width: 180px;">{{ $details['name'] }}</h6>
                                        <small class="text-muted">SL: {{ $details['quantity'] }} x {{ number_format($details['price']) }} đ</small>
                                    </div>
                                    <span class="fw-bold text-danger">{{ number_format($subtotal) }} đ</span>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Tạm tính:</span>
                        <span class="fw-semibold">{{ number_format($total) }} đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Phí vận chuyển:</span>
                        <span class="text-success fw-semibold">Miễn phí</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Tổng tiền:</span>
                        <span class="text-danger fw-bold fs-5">{{ number_format($total) }} đ</span>
                    </div>

                    <button type="submit" class="btn btn-luxury w-100 py-3 rounded-pill fw-bold fs-6">
                        <i class="bi bi-check-circle me-2"></i> Xác Nhận Đặt Hàng
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radCod = document.getElementById('payment_cod');
        const radBank = document.getElementById('payment_bank');
        const qrBox = document.getElementById('qr-code-box');

        function toggleQR() {
            if (radBank.checked) {
                qrBox.classList.remove('d-none'); // Hiện khung QR
            } else {
                qrBox.classList.add('d-none');    // Ẩn khung QR
            }
        }

        // Lắng nghe sự kiện thay đổi radio
        radCod.addEventListener('change', toggleQR);
        radBank.addEventListener('change', toggleQR);
    });
</script>
@endpush
@endsection
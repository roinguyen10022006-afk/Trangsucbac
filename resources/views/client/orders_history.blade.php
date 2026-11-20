@extends('layouts.client')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">📜 Lịch sử đơn hàng của bạn</h3>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($orders->isEmpty())
    <div class="alert alert-info text-center py-4">
        <p class="mb-2">Bạn chưa có đơn hàng nào!</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Khám phá sản phẩm ngay</a>
    </div>
    @else
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-bordered align-middle mb-0 bg-white">
            <thead class="table-dark text-center">
                <tr>
                    <th>Mã đơn</th>
                    <th>Ngày đặt</th>
                    <th>Người nhận</th>
                    <th>Địa chỉ giao hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td class="text-center fw-bold">#{{ $order->id }}</td>
                    <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <strong>{{ $order->receiver_name }}</strong><br>
                        <small class="text-muted">{{ $order->receiver_phone }}</small>
                    </td>
                    <td>{{ $order->shipping_address }}</td>
                    <td class="text-end text-danger fw-bold">{{ number_format($order->total_amount) }} đ</td>
                    <td class="text-center">
                        <span class="badge bg-warning text-dark">{{ $order->status ?? 'Chờ duyệt' }}</span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('orders.detail', $order->id) }}" class="btn btn-sm btn-outline-primary">
                            Xem chi tiết
                        </a>
                         <!-- CHỈ HIỆN NÚT HỦY KHI ĐƠN Ở TRẠNG THÁI CHỜ DUYỆT -->
                        @if(($order->status ?? 'Chờ duyệt') == 'Chờ duyệt')
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?');">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hủy đơn</button>
                        </form>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
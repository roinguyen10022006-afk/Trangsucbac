@extends('layouts.client')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Chi tiết đơn hàng #{{ $order->id }}</h4>
        <a href="{{ route('orders.history') }}" class="btn btn-outline-secondary btn-sm">⬅ Quay lại danh sách</a>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h6><strong>Người nhận:</strong> {{ $order->receiver_name }} - {{ $order->receiver_phone }}</h6>
            <h6><strong>Địa chỉ:</strong> {{ $order->shipping_address }}</h6>
            <h6><strong>Trạng thái:</strong> <span class="badge bg-info text-dark">{{ $order->status }}</span></h6>
        </div>
    </div>

    <h5 class="fw-bold mb-3">Sản phẩm đã đặt</h5>
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name ?? 'Sản phẩm' }}</td>
                        <td>{{ number_format($detail->price) }} đ</td>
                        <td>{{ $detail->quantity }}</td>
                        <td class="fw-bold">{{ number_format($detail->price * $detail->quantity) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class UserOrderController extends Controller
{
    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('client.orders_history', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::where('user_id', Auth::id())->with('orderDetails.product')->findOrFail($id);
        return view('client.order_detail', compact('order'));
    }


    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'Chờ duyệt')
            ->findOrFail($id);

        // Cập nhật trạng thái đơn hàng thành 'Đã hủy'
        $order->update(['status' => 'Đã hủy']);

        // Hoàn trả lại số lượng tồn kho cho các sản phẩm trong đơn
        foreach ($order->orderDetails as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $product->increment('stock_quantity', $detail->quantity);
            }
        }

        return redirect()->back()->with('success', 'Đã hủy đơn hàng thành công!');
    }
}

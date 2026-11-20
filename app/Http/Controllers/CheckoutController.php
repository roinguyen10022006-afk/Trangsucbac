<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        return view('client.checkout');
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống!');
        }

        DB::transaction(function () use ($request, $cart) {
            $totalAmount = 0;
            foreach ($cart as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            // Tạo đơn hàng
            $order = Order::create([
                'user_id' => Auth::id(),
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'shipping_address' => $request->shipping_address,
                'note' => $request->note,
                'total_amount' => $totalAmount,
                'payment_method' => $request->payment_method ?? 'COD',
                'status' => 'Chờ duyệt',
            ]);

            // Tạo chi tiết đơn hàng & Trừ số lượng tồn kho
            foreach ($cart as $productId => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            // Xóa giỏ hàng sau khi đặt thành công
            session()->forget('cart');
        });

        return redirect()->route('orders.history')->with('success', 'Đặt hàng thành công! Cảm ơn bạn đã mua sắm tại Silver Luxe.');
    }
}
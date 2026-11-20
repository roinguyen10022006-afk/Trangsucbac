<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating'    => 'required|integer|min:1|max:5',
            'comment'   => 'required|string|max:1000',
            'user_name' => 'nullable|string|max:255',
        ], [
            'rating.required'  => 'Vui lòng chọn từ 1 đến 5 sao để đánh giá.',
            'comment.required' => 'Vui lòng nhập nội dung nhận xét sản phẩm.',
        ]);

        $product = Product::findOrFail($productId);

        Review::create([
            'product_id' => $product->id,
            'user_id'    => auth()->id(), // Tự lấy ID nếu đã đăng nhập
            'user_name'  => auth()->check() ? auth()->user()->name : ($request->user_name ?? 'Khách hàng'),
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi đánh giá cho sản phẩm!');
    }
}
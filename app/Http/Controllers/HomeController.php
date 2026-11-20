<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất hiển thị ra Trang chủ
        $products = Product::latest()->take(8)->get(); 

        // 🟢 Trả về giao diện Trang chủ client.home
        return view('client.home', compact('products'));
    }
}
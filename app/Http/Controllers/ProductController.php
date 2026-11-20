<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm theo Danh mục + Bộ lọc giá & Sắp xếp
     */
    public function category(Request $request, $slug)
    {
        $categoryMap = [
            'nhan-bac'    => ['name' => 'Nhẫn Bạc',   'id' => 1],
            'day-chuyen'  => ['name' => 'Dây Chuyền', 'id' => 2],
            'bong-tai'    => ['name' => 'Bông Tai',   'id' => 3],
            'vong-tay'    => ['name' => 'Vòng & Lắc', 'id' => 4],
        ];

        $info = $categoryMap[$slug] ?? ['name' => 'Trang Sức Bạc', 'id' => 1];
        $categoryName = $info['name'];
        $categoryId   = $info['id'];

        $query = Product::query();

        // 1. Lọc theo Danh mục
        if (Schema::hasColumn('products', 'category_id')) {
            $query->where('category_id', $categoryId);
        } elseif (Schema::hasColumn('products', 'category')) {
            $query->where('category', $categoryName);
        }

        // 2. Lọc theo Mức giá (price_range)
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'under-500':
                    $query->where('price', '<', 500000);
                    break;
                case '500-1000':
                    $query->whereBetween('price', [500000, 1000000]);
                    break;
                case 'over-1000':
                    $query->where('price', '>', 1000000);
                    break;
            }
        }

        // 3. Sắp xếp sản phẩm (sort)
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // 4. Phân trang & Giữ bộ lọc khi bấm sang trang 2, 3...
        $products = $query->paginate(12)->withQueryString();

        return view('client.products.index', compact('products', 'categoryName', 'slug'));
    }

    /**
     * Xem trang Chi tiết sản phẩm
     */
    public function show($id)
{
    // Lấy sản phẩm kèm danh sách đánh giá
    $product = Product::with('reviews')->findOrFail($id);

    $relatedProducts = Product::where('id', '!=', $id);
    if (isset($product->category_id)) {
        $relatedProducts->where('category_id', $product->category_id);
    }
    $relatedProducts = $relatedProducts->latest()->take(4)->get();

    return view('client.products.show', compact('product', 'relatedProducts'));
}

}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm + Tìm kiếm & Phân trang
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // Thêm sản phẩm trang sức mới kèm Upload ảnh
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'purity' => $request->purity ?? 'Bạc 925',
            'description' => $request->description,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Thêm trang sức mới thành công!');
    }

    // 1. Hiển thị form chỉnh sửa sản phẩm (MỚI THÊM)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 2. Cập nhật thông tin sản phẩm vào CSDL (MỚI THÊM)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_quantity' => $request->stock_quantity,
            'purity' => $request->purity ?? 'Bạc 925',
            'description' => $request->description,
        ];

        // Nếu người dùng tải lên hình ảnh mới
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ trong ổ đĩa storage nếu có
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Lưu hình ảnh mới
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm thành công!');
    }
    public function category($slug)
{
    // Ánh xạ slug trên URL với ID danh mục thực tế trong CSDL của bạn
    // (Thay 1, 2, 3, 4 bằng ID chuẩn trong bảng categories của bạn)
    $categoryIds = [
        'nhan-bac'    => 1, // ID của Nhẫn Bạc trong CSDL
        'day-chuyen'  => 2, // ID của Dây Chuyền trong CSDL
        'bong-tai'    => 3, // ID của Bông Tai trong CSDL
        'vong-tay'    => 4, // ID của Vòng & Lắc trong CSDL
    ];

    $categoryId = $categoryIds[$slug] ?? 1;

    // Lọc theo cột category_id
    $products = Product::where('category_id', $categoryId) // 👈 Đã sửa thành category_id
                       ->latest()
                       ->paginate(8);

    return view('client.home', compact('products'));
}
}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Quản Lý Sản Phẩm Trang Sức</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Ô tìm kiếm --}}
    <form action="{{ route('admin.products.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm tên trang sức..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary">Tìm kiếm</button>
        </div>
    </form>

    {{-- Form thêm sản phẩm mới (Có Upload Ảnh enctype="multipart/form-data") --}}
    <div class="card mb-4">
        <div class="card-header">Thêm Trang Sức Mới</div>
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Giá (VNĐ)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Số lượng kho</label>
                        <input type="number" name="stock_quantity" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Hình ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-success">Lưu Sản Phẩm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Bảng hiển thị danh sách sản phẩm --}}
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Hình Ảnh</th>
                <th>Tên Trang Sức</th>
                <th>Danh Mục</th>
                <th>Giá Bán</th>
                <th>Số Lượng</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="60" class="img-thumbnail">
                    @else
                        <span class="badge bg-secondary">Chưa có ảnh</span>
                    @endif
                </td>
                <td><strong>{{ $product->name }}</strong></td>
                <td>{{ $product->category->name ?? 'N/A' }}</td>
                <td>{{ number_format($product->price) }}đ</td>
                <td>{{ $product->stock_quantity }}</td>
                <td>
                   <div class="d-flex gap-1">
        {{-- Nút Sửa --}}
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm">Sửa</a>
 
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
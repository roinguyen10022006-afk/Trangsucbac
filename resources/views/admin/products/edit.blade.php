@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chỉnh Sửa Sản Phẩm Trang Sức</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay Lại Danh Sách</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Giá (VNĐ)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Số lượng kho</label>
                        <input type="number" name="stock_quantity" class="form-control" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Hình ảnh mới (Để trống nếu giữ ảnh cũ)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        
                        @if($product->image)
                            <div class="mt-2">
                                <small class="text-muted">Ảnh hiện tại:</small><br>
                                <img src="{{ asset('storage/' . $product->image) }}" width="80" class="img-thumbnail mt-1">
                            </div>
                        @endif
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
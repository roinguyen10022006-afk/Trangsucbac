@extends('layouts.app') {{-- Hoặc file layout admin của bạn --}}

@section('content')
<div class="container py-4">
    <h2>Quản Lý Danh Mục Trang Sức</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form thêm danh mục --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Tên danh mục (VD: Lắc Chân Bạc)" required>
            <button type="submit" class="btn btn-primary">Thêm Danh Mục</button>
        </div>
    </form>

    {{-- Bảng danh sách danh mục --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Slug</th>
                <th>Số Sản Phẩm</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->slug }}</td>
                <td>{{ $cat->products_count }}</td>
                <td>
                    <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa danh mục này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
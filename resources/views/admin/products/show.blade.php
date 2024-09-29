@extends('layouts.app')

@section('content')
    <h1>{{ $product->name }}</h1>

    <p>{{ $product->description }}</p>
    <p>Số lượng: {{ $product->quantity }}</p>
    <p>Giá: {{ $product->price }}</p>
    <p>Danh mục: {{ $product->category->name }}</p>
    @auth
        <!-- Form để thêm sản phẩm vào giỏ hàng -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
        </form>
    @else
        <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để thêm sản phẩm vào giỏ hàng.</p>
    @endauth
    <a href="{{ route('welcome') }}">Quay lại danh sách</a>
@endsection
<div class="container mt-4">
    <h1 class="mb-4">{{ $product->name }}</h1>

    <div class="mb-3">
        <p><strong>Mô tả:</strong> {{ $product->description }}</p>
        <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
        <p><strong>Giá:</strong> {{ number_format($product->price, 2) }} VND</p>
        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
    </div>

    <div class="mb-3">
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Xóa</button>
        </form>
    </div>
</div>
@endsection
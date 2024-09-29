@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Danh sách sản phẩm</h1>
    
    <div class="mb-3">
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            Danh mục: {{ $product->category->name }} <br>
                            Giá: {{ number_format($product->price, 2) }} VND
                        </p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

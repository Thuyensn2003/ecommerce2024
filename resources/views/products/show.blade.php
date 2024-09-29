@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Hình ảnh sản phẩm -->
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1 class="mb-4">{{ $product->name }}</h1>
            <p class="lead text-danger">{{ number_format($product->price, 2) }} VND</p>
            <div class="mb-3">
                <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                <p><strong>Số lượng:</strong> {{ $product->quantity }}</p>
                <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
            </div>

            <div class="mb-3">
                <label for="quantity"><strong>Số lượng:</strong></label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" class="form-control w-25">
            </div>
            <div class="mb-3">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" onsubmit="setQuantity(this)">
                    @csrf
                    <input type="hidden" name="quantity" value="1" id="hidden-quantity-buy">
                    <button type="submit" class="btn btn-warning btn-lg">Mua ngay</button>
                </form>
            </div>
            <div class="mb-3">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" onsubmit="setQuantity(this)">
                    @csrf
                    <input type="hidden" name="quantity" value="1" id="hidden-quantity-cart">
                    <button type="submit" class="btn btn-primary btn-lg">Thêm vào giỏ hàng</button>
                </form>
            </div>
            <div class="mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Cập nhật số lượng ẩn khi nhấn nút
    function setQuantity(form) {
        const quantityInput = document.getElementById('quantity');
        const hiddenQuantity = form.querySelector('input[name="quantity"]');
        hiddenQuantity.value = quantityInput.value;
    }
</script>
@endsection

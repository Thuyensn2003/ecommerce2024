@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">
    <h1 class="mb-4">Giỏ hàng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <!-- Nút + và - để thay đổi số lượng -->
                            <div class="input-group quantity-update">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary btn-decrement" data-id="{{ $id }}">-</button>
                                </div>
                                <input type="number" class="form-control text-center" value="{{ $details['quantity'] }}" min="1" data-id="{{ $id }}">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-increment" data-id="{{ $id }}">+</button>
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($details['price'], 2) }}</td>
                        <td class="item-total">{{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                        <td>{{ $details['category'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Tổng: <span id="cart-total">{{ number_format($total, 2) }}</span> VND</h3>
    @else
        <p>Giỏ hàng của bạn trống</p>
    @endif

    <a href="{{ route('products.index') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cập nhật số lượng và tính lại giá
    document.querySelectorAll('.quantity-update input').forEach(input => {
        input.addEventListener('change', function() {
            updateCart(this);
        });
    });

    document.querySelectorAll('.btn-increment').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.parentElement.previousElementSibling;
            input.value = parseInt(input.value) + 1;
            updateCart(input);
        });
    });

    document.querySelectorAll('.btn-decrement').forEach(button => {
        button.addEventListener('click', function() {
            let input = this.parentElement.nextElementSibling;
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateCart(input);
            }
        });
    });

    function updateCart(input) {
        let id = input.getAttribute('data-id');
        let quantity = input.value;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/cart/update/${id}`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Có lỗi xảy ra khi cập nhật giỏ hàng');
            }
            return response.json();
        })
        .then(data => {
            // Cập nhật tổng tiền cho sản phẩm và toàn bộ giỏ hàng
            input.closest('tr').querySelector('.item-total').innerText = data.itemTotal.toLocaleString('vi-VN', { minimumFractionDigits: 2 }) + ' VND';
            document.getElementById('cart-total').innerText = data.cartTotal.toLocaleString('vi-VN', { minimumFractionDigits: 2 }) + ' VND';
        })
        .catch(error => {
            alert(error.message); // Hiển thị thông báo lỗi cho người dùng
        });
    }
});
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="border p-4 rounded shadow-sm">
        <h2 class="mb-4">Thêm danh mục</h2>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" class="form-control col-md-6" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Tạo</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Thêm sản phẩm</h1>

    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="quantity">Số lượng:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}">
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
    </form>

    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách</a>
</div>
@endsection

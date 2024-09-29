@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4 rounded shadow-sm">
            <h2 class="mb-4">Sửa danh mục</h2>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-">
                    <label for="name">Tên danh mục:</label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Quay trở lại</a>
            </form>
        </div>
    </div>
@endsection

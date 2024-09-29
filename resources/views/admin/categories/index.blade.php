@extends('layouts.app')

@section('content')
<div class="container mt-4">


    <h1 class="mb-4">Danh mục</h1>

    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm danh mục mới</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
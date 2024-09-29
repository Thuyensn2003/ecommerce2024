@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm tài khoản</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input">
            <label for="is_admin" class="form-check-label">Quyền Admin</label>
        </div>

        <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chỉnh sửa tài khoản</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu (để trống nếu không muốn thay đổi)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_admin" id="is_admin" class="form-check-input" {{ $user->is_admin ? 'checked' : '' }}>
            <label for="is_admin" class="form-check-label">Quyền Admin</label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
    </form>
</div>
@endsection

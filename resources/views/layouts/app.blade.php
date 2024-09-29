<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMĐT</title>
    <!-- Bootstrap CSS từ CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar-custom {
            background-color: #34d2eb;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom navbar-light fixed-top">
        <div class="container">
            <!-- Các tùy chọn ngoài cùng bên trái -->
            <a class="navbar-brand" href="#">NTR Store</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Các tùy chọn ngoài cùng bên trái -->
                <ul class="navbar-nav mr-auto">
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">Tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">Danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">Sản phẩm</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index') }}">Danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">Giỏ hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">Tài khoản</a>
                        </li>
                    @endif
                </ul>

                <!-- Thanh tìm kiếm ở giữa -->
                <form class="form-inline mx-auto" action="" method="GET">
                    <input class="form-control mr-sm-2" type="search" name="query" placeholder="Tìm kiếm gì đó" aria-label="Search" style="width: 300px;">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>

                <!-- Tùy chọn "Thoát" ngoài cùng bên phải -->
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ở đây làm gì, {{ Auth::user()->name }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="form-inline">
                            @csrf
                            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Thoát</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        @yield('content')
    </div>

    <!-- jQuery và Bootstrap JS từ CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

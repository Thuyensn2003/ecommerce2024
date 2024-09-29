<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

// Route cho trang chính
Route::get('/', function () {
    return view('welcome');
});

// Route để thêm sản phẩm vào giỏ hàng
Route::middleware(['auth'])->post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
// Route để hiển thị giỏ hàng
Route::middleware(['auth'])->get('/cart', [CartController::class, 'index'])->name('cart.index');
// Route để xoá sản phẩm khỏi giỏ hàng
Route::middleware(['auth'])->delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
// Route cập nhật thông tin giỏ hàng
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');


// Route cho admin
// Các route cho danh mục
Route::get('admin/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
Route::get('admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
Route::post('admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
Route::get('admin/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
Route::put('admin/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
Route::delete('admin/categories/{id}', [AdminController::class, 'destroyCategory'])->name('admin.categories.destroy');

// Các route cho sản phẩm
Route::get('admin/products', [AdminController::class, 'products'])->name('admin.products.index');
Route::get('admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
Route::post('admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::get('admin/products/{name}/show', [AdminController::class, 'showProduct'])->name('admin.products.show');
Route::get('admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
Route::put('admin/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('admin/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');

// Các route quản lí tài khoản 
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
});

// Route cho người dùng
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('users/{id}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// Route cho các controller khác
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);

// Hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Xử lý đăng ký người dùng
Route::post('/register', [AuthController::class, 'register']);

// Hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Xử lý đăng nhập người dùng
Route::post('/login', [AuthController::class, 'login']);

// Xử lý đăng xuất người dùng
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
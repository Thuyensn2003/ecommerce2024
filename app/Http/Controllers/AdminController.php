<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Hiển thị danh sách danh mục
    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Hiển thị form tạo danh mục mới
    public function createCategory()
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.categories.create', compact('categories'));
    }

    // Xử lý lưu danh mục mới
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Xử lý cập nhật danh mục
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.categories.index');
    }

    // Xử lý xóa danh mục
    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.categories.index');
    }

    // Hiển thị danh sách sản phẩm
    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function createProduct()
    {
        
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Xử lý lưu sản phẩm mới
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        Product::create($request->all());
        return redirect()->route('admin.products.index');
    }
    public function showProduct(Product $product, $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function editProduct($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product','categories'));
    }

    // Xử lý cập nhật sản phẩm
    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('admin.products.index');
    }

    // Xử lý xóa sản phẩm
    public function destroyProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}

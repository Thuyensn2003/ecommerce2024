<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    // Hiển thị danh sách người dùng
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // Hiển thị form tạo người dùng
    public function create() {
        return view('admin.users.create');
    }

    // Lưu người dùng mới
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->has('is_admin') ? 'admin' : 'customer', // Sử dụng role
        ]);
        
        return redirect()->route('admin.users.index')->with('success', 'Thêm tài khoản thành công!');
    }

    // Hiển thị form chỉnh sửa người dùng
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed', // Password có thể bỏ trống
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        // Chỉ cập nhật password nếu có giá trị mới
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->role = $request->has('is_admin') ? 'admin' : 'customer'; // Cập nhật role
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    // Xóa người dùng 
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xoá tài khoản thành công!');
    }
}

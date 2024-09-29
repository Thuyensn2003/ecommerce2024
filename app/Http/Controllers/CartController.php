<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "category" => $product->category->name

            ];

        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
        }
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'quantity' => 'required|integer|min:1',
    ]);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        // Cập nhật số lượng
        $cart[$id]['quantity'] = $request->input('quantity');
        session()->put('cart', $cart);

        // Tính toán giá cho sản phẩm và tổng giỏ hàng
        $itemTotal = $cart[$id]['price'] * $cart[$id]['quantity'];
        $cartTotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        return response()->json([
            'itemTotal' => $itemTotal,
            'cartTotal' => $cartTotal
        ]);
    }

    return response()->json(['error' => 'Sản phẩm không tồn tại trong giỏ hàng'], 404);
}




}

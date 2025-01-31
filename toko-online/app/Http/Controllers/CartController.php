<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id', Auth::id())
                    ->get();
        return view('cart2.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);
        $product = Product::findOrFail($request->product_id);
        $cart = new Cart;
        $cart->user_id = Auth::id();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->route('carts.index')
            ->with('success', 'Product added to cart successfully!');
    }

    public function addToCartWithUser($product_id)
    {
        $product = Product::findOrFail($product_id);
        $check = Cart::where('user_id', Auth::id())
                    ->where('product_id', $product_id)
                    ->first();
        $quantity = $check != null ? $check->quantity + 1 : 1;

        $cart = $check != null ? $check : new Cart;
        $cart->user_id = Auth::id();
        $cart->product_id = $product_id;
        $cart->quantity = $quantity;
        $cart->save();
        return redirect()->route('carts.index')
            ->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::where([
                    ['id', $id],
                    ['user_id', Auth::id()]
                ])->firstOrFail();

        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->route('carts.index')
            ->with('success', 'Product quantity updated successfully!');
    }

    public function destroy($id)
    {
        $cart = Cart::where([
                    ['id', $id],
                    ['user_id', Auth::id()]
                ])->firstOrFail();
        $cart->delete();
        return redirect()->route('carts.index')
            ->with('error', 'Product removed from cart successfully!');
    }
    // Fungsi untuk menambahkan produk ke keranjang
    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        // Ambil data cart dari session (jika ada)
        $cart = session()->get('cart', []);

        $productId = $product->id;

        // Jika produk sudah ada di cart, tambahkan quantity
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        }else {
            // Jika produk belum ada di cart, tambahkan ke array
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // Fungsi untuk menampilkan isi keranjang
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        $productId = $request->id;

        // Perbarui quantity jika produk ada di cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    public function removeFromCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        $productId = $product->id;

        // Hapus produk dari cart jika ada
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('error', 'Product removed from cart.');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

}

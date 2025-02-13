<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //withCount jumlah data
        //withSum total data
        $products = Product::with('category')->paginate(10);
        // dd($products);
        // $product = Product::where('category_id', 1)->get();
        // $product = Product::where('category_id', 1)->all();
        // $product = Product::where('category_id', 1)->paginate(3);
        // $product = Product::where('category_id', 1)->first();
        // // Kalau ada ditampilakan yang pertama, kalau gak ada akan error 404
        // $product = Product::where('category_id', 1)->firstOrFail();
        // $product = Product::findOrFail(4);

        return view('dashboard.product.index', compact('products'));
    }

    public function click($id)
    {
        $product = Product::findOrFail($id);
        $product->click += 1;
        $product->save();
        return redirect()->route('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description'=>['required', 'string', 'max:255'],
            'price'=>['required', 'string' , 'max: 255'],
            'category'=>['required', 'max: 255'],
            'image'=>['required', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
            'stock'=>['required', 'string', 'max:255'],
        ]);

        $category = Category::findOrFail($request->category);
        
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $category->id;
        $product->stock = $request->stock;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $random_name = uniqid().".".$image->getClientOriginalExtension();
            $image->move(public_path('images'), $random_name);
            $product->image = '/images/'.$random_name;
        }
        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $clickedProducts = session()->get('clicked_products', []);

        if (!in_array($product->id, $clickedProducts)) {
            // Tambahkan ke session untuk mencegah penghitungan berulang
            $clickedProducts[] = $product->id;
            session()->put('clicked_products', $clickedProducts);
            // Update jumlah klik di database
            $product->click += 1;
            $product->save();
        }

        return view('dashboard.product.show', compact('product'));
    }

    public function order(Request $request)
    {
        if($request->cart_ids != null){
            $cart_ids = $request->cart_ids;
            $carts = Cart::whereIn('id', $cart_ids)
                        ->with('product')
                        ->get();

            $product_list = [];
            foreach($carts as $cart){
                $product_list[] = $cart->product->name.' ('.$cart->quantity.')';
            }

            $text = '
Halo Admin 😊,

Nama: '.$request->name.'
Whatsapp: '.$request->whatsapp.'
Alamat: '.$request->address.'

Saya mau order produk:
'.implode("
",$product_list).'
            
                        ';
            $wa_link = 'https://api.whatsapp.com/send?phone=6281548303303&text='.urlencode($text);
            // dd($wa_link);
            foreach($carts as $cart){
                $cart->delete();
            }

            return redirect($wa_link);
            // return view('dashboard.product.order', compact('products'));
        }else{
            return back()->with('error','Product not found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product      = Product::findOrFail($id);
        $categories   = Category::all();

        return view('dashboard.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description'=>['required', 'string', 'max:255'],
            'price'=>['required', 'string' , 'max: 255'],
            'category'=>['required', 'max: 255'],
            'stock'=>['required', 'string', 'max:255'],
        ]);

        $category = Category::findOrFail($request->category);
        
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $category->id;
        $product->stock = $request->stock;

        if($request->hasFile('image')) {
            $request->validate([
                'image' => ['required', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
            ]);
            $fullPath = public_path($product->image);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $image = $request->file('image');
            $random_name = uniqid().".".$image->getClientOriginalExtension();
            $image->move(public_path('images'), $random_name);
            $product->image = '/images/'.$random_name;
        }
        $product->save();

        return redirect()->route('product.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $fullPath = public_path($product->image);
        if(file_exists($fullPath)) {
            unlink($fullPath);
        }
        $product->delete();

        return redirect()->route('product.index')
            ->with('error', 'Product deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

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
            $image->move(public_path('images'), $image->getClientOriginalName());
            $product->image = '/images/'.$image->getClientOriginalName();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

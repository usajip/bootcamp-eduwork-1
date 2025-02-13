<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(3);

        $categories = Category::all();
        return view('home', compact('products', 'categories'));
    }


    public function searchProduct(Request $request){
        $search     = $request->search;
        $products   = Product::where('name', 'like', '%'.$search.'%')
                        ->paginate(10);
        $recommendation = Product::inRandomOrder()->limit(3)->get();
        // if($products->exists()){
        //     $products = $products->paginate(10);
        // }else{
        //     $products = Product::paginate(10);
        // }
        return view('home', compact('products', 'recommendation'));
    }

    public function productCategory($category_id)
    {
        $category = Category::where('id', $category_id)->first();
        $products = Product::where('category_id', $category_id)->paginate(10);
        $recommendation = Product::inRandomOrder()->limit(3)->get();
        $categories = Category::all();

        return view('home', compact('category', 'products', 'recommendation', 'categories'));
    }
}

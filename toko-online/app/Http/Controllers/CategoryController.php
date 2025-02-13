<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('product')
                        ->with('product')
                        ->withSum('product as total_price', 'price')
                        ->paginate(5);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashboard.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=> 'required|string|max:255'
        ]);

        $check = Category::where('name', $request->name)->exists(); // true/false

        if($check) {
            return back()->with('error', $request->name.' category already exists');
        }else{
            $category = new Category;
            $category->name = $request->name;
            $category->save();
            return redirect()->route('category.index')
                ->with('success', 'Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
        ]);

        $check_name = Category::where('name', $request->name)->exists();
        
        if($check_name) {
            return back()->with('error', $request->name.' category already exists');
        }else{
            $category->name = $request->name;
            $category->save();
            return redirect()->route('category.index')
                ->with('success', 'Category updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $product = Product::where('category_id', $category->id)->get();

        foreach($product as $item) {
            $fullPath = public_path($item->image);
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
            $item->delete();
        }

        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully');
    }
}

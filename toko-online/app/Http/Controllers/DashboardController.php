<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahProduct = Product::count();
        $jumlahCategory = Category::count();
        $jumlahKlikProduct = Product::sum('click');
        $jumlahKeranjang = Cart::sum('quantity');
        return view('dashboard',
            compact('jumlahProduct', 'jumlahCategory', 'jumlahKlikProduct','jumlahKeranjang')
        );
    }
}

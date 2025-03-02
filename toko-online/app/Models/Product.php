<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = ['name', 'image', 'stock', 'price', 'description', 'click'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);    
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
}

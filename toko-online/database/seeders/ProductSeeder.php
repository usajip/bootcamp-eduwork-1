<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Meja',
                'description' => 'This is the description for Product 1.',
                'price' => 100000,
                'stock' => 10,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLOpeYPzObh08ci4WIZmCmKfxEukTdgDXTtw&s',
                'category_id'=>1,
            ],
            [
                'name' => 'Product 2',
                'description' => 'This is the description for Product 2.',
                'price' => 200000,
                'stock' => 20,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLOpeYPzObh08ci4WIZmCmKfxEukTdgDXTtw&s',
                'category_id'=>2,
            ],
            [
                'name' => 'Product 3',
                'description' => 'This is the description for Product 3.',
                'price' => 300000,
                'stock' => 15,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLOpeYPzObh08ci4WIZmCmKfxEukTdgDXTtw&s',
                'category_id'=>3,
            ],
            [
                'name' => 'Product 4',
                'description' => 'This is the description for Product 4.',
                'price' => 400000,
                'stock' => 5,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLOpeYPzObh08ci4WIZmCmKfxEukTdgDXTtw&s',
                'category_id'=>4,
            ],
            [
                'name' => 'Product 5',
                'description' => 'This is the description for Product 5.',
                'price' => 500000,
                'stock' => 8,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLOpeYPzObh08ci4WIZmCmKfxEukTdgDXTtw&s',
                'category_id'=>1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

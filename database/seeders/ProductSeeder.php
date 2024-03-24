<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        

        Product::create([
            'title' => 'Sample Product 1',
            'slug' => 'sample-product-1',
            'quantity' => 10,
            'description' => 'Description of Sample Product 1',
            'published' => true,
            'inStock' => true,
            'price' => 99.99,
            'brand_id' => 3,
            'category_id' => 3,
        ]);

        Product::create([
            'title' => 'Sample Product 2',
            'slug' => 'sample-product-2',
            'quantity' => 20,
            'description' => 'Description of Sample Product 2',
            'published' => true,
            'inStock' => true,
            'price' => 149.99,
            'brand_id' => 1,
            'category_id' => 2,
        ]);

        Product::create([
            'title' => 'Another Product',
            'slug' => 'another-product',
            'quantity' => 15,
            'description' => 'Description of Another Product',
            'published' => true,
            'inStock' => true,
            'price' => 79.99,
            'brand_id' => 2,
            'category_id' => 1,
        ]);
    }
}

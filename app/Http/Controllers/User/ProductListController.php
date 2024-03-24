<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductListController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $productsQuery = Product::with('category', 'brand', 'product_images')->filter();
        $filterProducts = $productsQuery->paginate(9)->withQueryString();
        $products = $filterProducts->items(); // Retrieve the products from the paginated result

        // Pass the array of products to the view
        return Inertia::render(
            'User/ProductsList',
            [
                'products' => ProductResource::collection($products),
                'categories' => $categories,
                'brands' => $brands
            ]
        );
    }
}

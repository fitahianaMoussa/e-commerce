<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category','brand','product_images')->get();
        $brands = Brand::all();
        $categories = Category::all();

        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
       // dd($request->file('product_images'));
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->title = $request->title;

        $product->save();
        $productImages = $request->file('product_images');
        //check if product has images upload
        if ($productImages) {
            foreach ($productImages as $image) {
                //Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                //Store the image in the public folder with the unique name
                $image->move('product_images', $uniqueName);
                //Create a new product_images record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::where('id',$id)->delete();
        return redirect()->route('admin.products.index')->with('success','Image deleted successfully');
    }

    public function update(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price; 
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $productImages = $request->file('product_images');
        //check if product has images upload
        if ($productImages) {
            foreach ($productImages as $image) {
                //Generate a unique name for the image using timestamp and random string
                $uniqueName = time() . '-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                //Store the image in the public folder with the unique name
                $image->move('product_images', $uniqueName);
                //Create a new product_images record with the product_id and unique name
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'product_images/' . $uniqueName,
                ]);
            }
        }
        $product->update();

        return redirect()->back()->with('success', 'Product modified successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id)->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted successfully.');
    }
}

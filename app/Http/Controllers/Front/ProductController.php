<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->latest()->paginate(12);
        $categories = Category::all();
        return view('front.products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('front.products.show', compact('product'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('is_active', true)->paginate(12);
        $categories = Category::all(); // <-- ADD THIS LINE
        return view('front.products.index', compact('products', 'category', 'categories'));
    }
}
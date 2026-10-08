<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Latest active products
        $products = Product::with('category')
            ->where('status', true)
            ->where('stock', '>', 0)
            ->latest()
            ->take(8)
            ->get();

        // Active categories
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'home',
            compact('products', 'categories')
        );
    }
}
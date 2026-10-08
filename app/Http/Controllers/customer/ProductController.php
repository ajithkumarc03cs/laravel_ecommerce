<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display all available products.
     */
    public function index(Request $request)
    {
        $query = Product::with('category')
            ->where('status', true)
            ->where('stock', '>', 0);

        // Search
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Category filter
        if ($request->filled('category_id')) {
            $query->where(
                'category_id',
                $request->category_id
            );
        }

        // Products
        $products = $query
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Active categories
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'customer.products.index',
            compact('products', 'categories')
        );
    }

    /**
     * Display single product.
     */
    public function show(Product $product)
    {

        // Don't show inactive/out-of-stock products
        if (!$product->status || $product->stock <= 0) {
            abort(404);
        }

        return view(
            'customer.products.show',
            compact('product')
        );
    }
}
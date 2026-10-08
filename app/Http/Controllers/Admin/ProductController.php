<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Product List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Admin can see ALL products
        |--------------------------------------------------------------------------
        */

        $query = Product::with([
            'category',
            'seller'
        ]);


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if (
            $request->has('status')
            &&
            $request->status !== ''
        ) {

            $query->where(
                'status',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = Category::orderBy('name')->get();


        return view(
            'admin.products.index',
            compact(
                'products',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Create Product Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.products.create',
            compact('categories')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Product
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'status' => [
                'required',
                'boolean'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->name);


        /*
        |--------------------------------------------------------------------------
        | Make Unique Slug
        |--------------------------------------------------------------------------
        */

        $originalSlug = $slug;

        $count = 1;


        while (
            Product::where('slug', $slug)->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }


        /*
        |--------------------------------------------------------------------------
        | Image Upload
        |--------------------------------------------------------------------------
        */

        $imagePath = null;


        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | SKU Auto Generate
        |--------------------------------------------------------------------------
        */

        $sku = 'SKU-' . strtoupper(
            Str::random(8)
        );


        /*
        |--------------------------------------------------------------------------
        | Create Product
        |--------------------------------------------------------------------------
        */

        Product::create([

            'name' => $request->name,

            'slug' => $slug,

            'description' => $request->description,

            'price' => $request->price,

            'discount_price' => $request->discount_price,

            'stock' => $request->stock,

            'sku' => $sku,

            'image' => $imagePath,

            'status' => $request->status,

            'category_id' => $request->category_id,

            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            | Product creator
            |--------------------------------------------------------------------------
            */

            'user_id' => auth()->id(),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Product
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product)
    {
        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.products.edit',
            compact(
                'product',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'description' => [
                'nullable',
                'string'
            ],

            'price' => [
                'required',
                'numeric',
                'min:0'
            ],

            'discount_price' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'stock' => [
                'required',
                'integer',
                'min:0'
            ],

            'category_id' => [
                'required',
                'exists:categories,id'
            ],

            'status' => [
                'required',
                'boolean'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        $imagePath = $product->image;


        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($request->name);


        $originalSlug = $slug;

        $count = 1;


        while (
            Product::where('slug', $slug)
                ->where('id', '!=', $product->id)
                ->exists()
        ) {

            $slug = $originalSlug . '-' . $count;

            $count++;

        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $product->update([

            'name' => $request->name,

            'slug' => $slug,

            'description' => $request->description,

            'price' => $request->price,

            'discount_price' => $request->discount_price,

            'stock' => $request->stock,

            'category_id' => $request->category_id,

            'image' => $imagePath,

            'status' => $request->status,

        ]);


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Product
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        $product->delete();


        return redirect()
            ->route('admin.products.index')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }
}
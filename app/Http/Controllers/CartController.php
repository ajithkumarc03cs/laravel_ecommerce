<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Add Product To Cart
    |--------------------------------------------------------------------------
    */

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $quantity = $request->quantity;

        // Stock check
        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'Requested quantity is not available.'
            );
        }

        // Existing cart
        $cart = session()->get('cart', []);

        // Product already exists
        if (isset($cart[$product->id])) {

            $newQuantity =
                $cart[$product->id]['quantity'] + $quantity;

            if ($newQuantity > $product->stock) {
                return back()->with(
                    'error',
                    'You cannot add more than available stock.'
                );
            }

            $cart[$product->id]['quantity'] = $newQuantity;

        } else {

            // New product
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->discount_price
                    ?? $product->price,
                'image' => $product->image,
                'quantity' => $quantity,
            ];
        }

        // Save cart into session
        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to cart successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Cart Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cart = session()->get('cart', []);

        return view(
            'customer.cart.index',
            compact('cart')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Quantity
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$productId])) {
            return back()->with(
                'error',
                'Product not found in cart.'
            );
        }

        $product = Product::findOrFail($productId);

        if ($request->quantity > $product->stock) {
            return back()->with(
                'error',
                'Requested quantity is greater than available stock.'
            );
        }

        $cart[$productId]['quantity'] =
            $request->quantity;

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'Cart updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Product
    |--------------------------------------------------------------------------
    */

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {

            unset($cart[$productId]);

            session()->put('cart', $cart);
        }

        return back()->with(
            'success',
            'Product removed from cart.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */

    public function clear()
    {
        session()->forget('cart');

        return back()->with(
            'success',
            'Cart cleared successfully.'
        );
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view(
            'customer.checkout.index',
            compact('cart', 'total')
        );
    }

    public function placeOrder(Request $request)
    {

        $request->validate([
            'address' => 'required|string|min:10',
            'payment_method' => 'required|in:cod',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($cart as $item) {

                $product = Product::findOrFail($item['id']);

                if ($item['quantity'] > $product->stock) {

                    DB::rollBack();

                    return back()->with(
                        'error',
                        $product->name . ' does not have enough stock.'
                    );
                }

                $total +=
                    $item['price'] *
                    $item['quantity'];
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'address' => $request->address,
            ]);

            foreach ($cart as $item) {

                $product = Product::findOrFail($item['id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);

                $product->decrement(
                    'stock',
                    $item['quantity']
                );
            }

            session()->forget('cart');

            DB::commit();

            return redirect()
                ->route('customer.dashboard')
                ->with(
                    'success',
                    'Order placed successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            dd([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
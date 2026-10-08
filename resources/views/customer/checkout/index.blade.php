@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="checkout-container">

    <h1>Checkout</h1>

    <div class="checkout-grid">

        {{-- Order Summary --}}
        <div class="order-summary">

            <h2>Order Summary</h2>

            @foreach($cart as $item)

                <div class="cart-item">

                    <div class="product-image">

                        @if(!empty($item['image']))
                            <img
                                src="{{ asset('storage/' . $item['image']) }}"
                                alt="{{ $item['name'] }}"
                            >
                        @else
                            <div class="no-image">
                                No Image
                            </div>
                        @endif

                    </div>

                    <div class="product-info">

                        <h3>{{ $item['name'] }}</h3>

                        <p>
                            Price:
                            ₹{{ number_format($item['price'], 2) }}
                        </p>

                        <p>
                            Quantity:
                            {{ $item['quantity'] }}
                        </p>

                        <p>
                            Subtotal:
                            ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                        </p>

                    </div>

                </div>

            @endforeach

            <div class="total">

                <strong>Total Amount:</strong>

                <span>
                    ₹{{ number_format($total, 2) }}
                </span>

            </div>

        </div>


        {{-- Checkout Form --}}
        <div class="checkout-form">

            <h2>Delivery Details</h2>

            @if(session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())

                <div class="error">

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif

            <form
                action="{{ route('checkout.placeOrder') }}"
                method="POST"
            >

                @csrf

                <div class="form-group">

                    <label for="address">
                        Delivery Address
                    </label>

                    <textarea
                        name="address"
                        id="address"
                        rows="6"
                        placeholder="Enter your complete delivery address"
                        required
                    >{{ old('address') }}</textarea>

                </div>


                <div class="form-group">

                    <label>
                        Payment Method
                    </label>

                    <div class="payment-option">

                        <input
                            type="radio"
                            name="payment_method"
                            value="cod"
                            id="cod"
                            checked
                        >

                        <label for="cod">
                            Cash on Delivery (COD)
                        </label>

                    </div>

                </div>


                <div class="final-total">

                    <span>Total Payable:</span>

                    <strong>
                        ₹{{ number_format($total, 2) }}
                    </strong>

                </div>


                <button type="submit" class="place-order-btn">
                    Place Order
                </button>

            </form>

            <a
                href="{{ route('cart.index') }}"
                class="back-cart"
            >
                ← Back to Cart
            </a>

        </div>

    </div>

</div>

@endsection


@push('styles')

<style>

.checkout-container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
}

.checkout-container h1 {
    margin-bottom: 30px;
}

.checkout-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.order-summary,
.checkout-form {
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

.order-summary h2,
.checkout-form h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.cart-item {
    display: flex;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #ddd;
}

.product-image img {
    width: 90px;
    height: 90px;
    object-fit: contain;
}

.no-image {
    width: 90px;
    height: 90px;
    background: #eee;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
    font-size: 13px;
}

.product-info {
    flex: 1;
}

.product-info h3 {
    margin: 0 0 10px;
}

.product-info p {
    margin: 5px 0;
    color: #555;
}

.total {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #222;
    font-size: 20px;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    resize: vertical;
    font-family: Arial, sans-serif;
}

.payment-option {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

.payment-option label {
    margin: 0;
    font-weight: normal;
}

.error {
    background: #f8d7da;
    color: #842029;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.error ul {
    margin: 0;
    padding-left: 20px;
}

.final-total {
    display: flex;
    justify-content: space-between;
    font-size: 20px;
    margin: 25px 0;
    padding: 15px 0;
    border-top: 1px solid #ddd;
}

.place-order-btn {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 6px;
    background: #198754;
    color: white;
    font-size: 17px;
    cursor: pointer;
}

.place-order-btn:hover {
    background: #157347;
}

.back-cart {
    display: inline-block;
    margin-top: 15px;
    color: #333;
    text-decoration: none;
}

@media (max-width: 768px) {

    .checkout-grid {
        grid-template-columns: 1fr;
    }

}

</style>

@endpush
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Shopping Cart - My E-Commerce</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #222;
        }

        .navbar {
            background: #111;
            color: white;
            padding: 18px 6%;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .title {
            margin-bottom: 25px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .cart-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 100px 1fr 120px 150px 100px;
            gap: 20px;

            align-items: center;

            padding: 20px 0;

            border-bottom: 1px solid #ddd;
        }

        .cart-image {
            width: 90px;
            height: 90px;

            object-fit: contain;

            background: #f5f5f5;

            border-radius: 8px;
        }

        .cart-name {
            font-weight: bold;
            font-size: 18px;
        }

        .price {
            font-weight: bold;
        }

        .quantity-form {
            display: flex;
            gap: 5px;
        }

        .quantity-input {
            width: 60px;
            padding: 8px;
        }

        button {
            border: none;
            cursor: pointer;
        }

        .update-btn {
            background: #2563eb;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .remove-btn {
            background: #dc2626;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .cart-summary {
            margin-top: 30px;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total {
            font-size: 24px;
            font-weight: bold;
        }

        .clear-btn {
            background: #111;
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
        }

        .continue-btn {
            display: inline-block;

            margin-top: 20px;

            background: #e5e7eb;
            color: #111;

            padding: 12px 20px;

            text-decoration: none;

            border-radius: 6px;
        }

        .empty {
            text-align: center;
            padding: 60px 20px;
        }

        .empty h2 {
            margin-bottom: 15px;
        }

        .shop-btn {
            display: inline-block;

            margin-top: 20px;

            background: #111;
            color: white;

            padding: 12px 25px;

            text-decoration: none;

            border-radius: 6px;
        }

        @media (max-width: 800px) {

            .cart-item {
                grid-template-columns: 80px 1fr;
            }

            .cart-summary {
                flex-direction: column;
                gap: 20px;
                align-items: flex-start;
            }

        }

    </style>

</head>


<body>


<nav class="navbar">

    <div class="logo">
        🛍️ My E-Commerce
    </div>

  <div class="nav-links">

    <a href="{{ route('home') }}">
        Home
    </a>

    <a href="{{ route('products.index') }}">
        Products
    </a>

    <a href="{{ route('cart.index') }}">
        🛒 Cart
    </a>

    @auth

        <a href="{{ route('customer.dashboard') }}">
            My Account
        </a>

    @else

        <a
            href="{{ route('login') }}"
            class="login-btn"
        >
            Login
        </a>

        <a
            href="{{ route('register') }}"
            class="register-btn"
        >
            Register
        </a>

    @endauth

</div>
</nav>


<div class="container">

    <h1 class="title">
        Shopping Cart
    </h1>


    @if(session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="error">
            {{ session('error') }}
        </div>

    @endif


    @if(count($cart) > 0)

        <div class="cart-container">


            @php
                $total = 0;
            @endphp


            @foreach($cart as $item)

                @php
                    $itemTotal =
                        $item['price'] * $item['quantity'];

                    $total += $itemTotal;
                @endphp


                <div class="cart-item">


                    {{-- Product Image --}}

                    <div>

                        @if($item['image'])

                            <img
                                src="{{ asset('storage/' . $item['image']) }}"
                                alt="{{ $item['name'] }}"
                                class="cart-image"
                            >

                        @else

                            <div class="cart-image">
                                No Image
                            </div>

                        @endif

                    </div>


                    {{-- Product Name --}}

                    <div>

                        <div class="cart-name">
                            {{ $item['name'] }}
                        </div>

                        <div>
                            ₹{{ number_format($item['price'], 2) }}
                        </div>

                    </div>


                    {{-- Quantity --}}

                    <div>

                        <form
                            method="POST"
                            action="{{ route('cart.update', $item['id']) }}"
                            class="quantity-form"
                        >

                            @csrf

                            @method('PUT')

                            <input
                                type="number"
                                name="quantity"
                                value="{{ $item['quantity'] }}"
                                min="1"
                                class="quantity-input"
                            >

                            <button
                                type="submit"
                                class="update-btn"
                            >
                                Update
                            </button>

                        </form>

                    </div>


                    {{-- Item Total --}}

                    <div class="price">

                        ₹{{ number_format($itemTotal, 2) }}

                    </div>


                    {{-- Remove --}}

                    <div>

                        <form
                            method="POST"
                            action="{{ route('cart.remove', $item['id']) }}"
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="remove-btn"
                            >
                                Remove
                            </button>

                        </form>

                    </div>


                </div>

            @endforeach


            {{-- Summary --}}

            <div class="cart-summary">

                <div class="total">

                    Total:
                    ₹{{ number_format($total, 2) }}

                </div>


                <form
                    method="POST"
                    action="{{ route('cart.clear') }}"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="clear-btn"
                    >
                        Clear Cart
                    </button>
                @auth

                <a
                    href="{{ route('checkout.index') }}"
                    class="checkout-btn"
                >
                    Proceed to Checkout
                </a>

               @else

                <a
                    href="{{ route('login') }}"
                    class="checkout-btn"
                >
                    Login to Checkout
                </a>

                <p class="login-message">
                    Please login to place your order.
                </p>

            @endauth
                </form>

            </div>


            <a
                href="{{ route('products.index') }}"
                class="continue-btn"
            >
                ← Continue Shopping
            </a>


        </div>


    @else

        <div class="cart-container empty">

            <h2>
                Your cart is empty
            </h2>

            <p>
                You haven't added any products yet.
            </p>

            <a
                href="{{ route('products.index') }}"
                class="shop-btn"
            >
                Start Shopping
            </a>

        </div>

    @endif


</div>


</body>

</html>
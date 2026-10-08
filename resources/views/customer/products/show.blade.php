<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $product->name }} - My E-Commerce
    </title>


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


        /* =========================
           NAVBAR
        ========================= */

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
            align-items: center;
            gap: 25px;
        }


        .nav-links a {
            color: white;
            text-decoration: none;
        }


        .nav-links a:hover {
            color: #ccc;
        }


        .login-btn {
            background: white;
            color: #111 !important;

            padding: 9px 16px;

            border-radius: 5px;
        }


        .register-btn {
            background: #2563eb;
            color: white !important;

            padding: 9px 16px;

            border-radius: 5px;
        }


        /* =========================
           BREADCRUMB
        ========================= */

        .breadcrumb {
            width: 90%;
            max-width: 1200px;

            margin: 25px auto;

            color: #666;
        }


        .breadcrumb a {
            color: #2563eb;
            text-decoration: none;
        }


        /* =========================
           PRODUCT
        ========================= */

        .container {
            width: 90%;
            max-width: 1200px;

            margin: 20px auto 60px;
        }


        .product-container {
            background: white;

            padding: 35px;

            border-radius: 12px;

            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 50px;

            box-shadow:
                0 3px 15px
                rgba(0, 0, 0, 0.08);
        }


        /* =========================
           IMAGE
        ========================= */

        .product-image-container {
            display: flex;

            align-items: center;
            justify-content: center;

            background: #f8f8f8;

            border-radius: 10px;

            min-height: 500px;
        }


        .product-image {
            width: 100%;
            max-height: 500px;

            object-fit: contain;

            border-radius: 10px;
        }


        .no-image {
            height: 500px;
            width: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            color: #777;

            background: #eee;

            border-radius: 10px;
        }


        /* =========================
           PRODUCT INFO
        ========================= */

        .product-info {
            padding: 15px 0;
        }


        .category {
            display: inline-block;

            background: #e5e7eb;

            color: #374151;

            padding: 7px 12px;

            border-radius: 20px;

            font-size: 13px;

            margin-bottom: 18px;
        }


        .product-name {
            font-size: 38px;

            line-height: 1.2;

            margin-bottom: 20px;
        }


        .sku {
            color: #777;

            font-size: 14px;

            margin-bottom: 25px;
        }


        /* =========================
           PRICE
        ========================= */

        .price-section {
            margin-bottom: 25px;
        }


        .old-price {
            color: #999;

            text-decoration: line-through;

            font-size: 20px;

            margin-right: 12px;
        }


        .current-price {
            font-size: 32px;

            font-weight: bold;
        }


        .discount {
            display: inline-block;

            margin-left: 10px;

            background: #dc2626;

            color: white;

            padding: 5px 9px;

            border-radius: 4px;

            font-size: 13px;
        }


        /* =========================
           DESCRIPTION
        ========================= */

        .description {
            margin: 25px 0;

            line-height: 1.7;

            color: #555;
        }


        .description h3 {
            color: #222;

            margin-bottom: 10px;
        }


        /* =========================
           STOCK
        ========================= */

        .stock {
            margin: 20px 0;

            font-size: 16px;
        }


        .stock-available {
            color: #16a34a;

            font-weight: bold;
        }


        /* =========================
           QUANTITY
        ========================= */

        .quantity-section {
            margin: 25px 0;
        }


        .quantity-section label {
            display: block;

            margin-bottom: 8px;

            font-weight: bold;
        }


        .quantity {
            width: 80px;

            padding: 11px;

            border: 1px solid #ccc;

            border-radius: 5px;

            font-size: 16px;
        }


        /* =========================
           BUTTONS
        ========================= */

        .buttons {
            display: flex;

            gap: 15px;

            margin-top: 25px;
        }


        .add-cart {
            background: #111;

            color: white;

            border: none;

            padding: 14px 30px;

            border-radius: 6px;

            font-size: 16px;

            cursor: pointer;
        }


        .add-cart:hover {
            background: #333;
        }


        .back-btn {
            display: inline-block;

            background: #e5e7eb;

            color: #111;

            padding: 14px 25px;

            border-radius: 6px;

            text-decoration: none;
        }


        .back-btn:hover {
            background: #d1d5db;
        }


        /* =========================
           FEATURES
        ========================= */

        .features {
            margin-top: 35px;

            padding-top: 25px;

            border-top: 1px solid #ddd;
        }


        .feature {
            display: flex;

            gap: 12px;

            margin-bottom: 15px;

            color: #555;
        }


        .feature-icon {
            font-size: 20px;
        }


        /* =========================
           FOOTER
        ========================= */

        .footer {
            background: #111;

            color: white;

            text-align: center;

            padding: 40px 20px;
        }


        .footer p {
            color: #aaa;

            margin-top: 10px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 800px) {

            .product-container {
                grid-template-columns: 1fr;

                gap: 25px;
            }


            .product-name {
                font-size: 30px;
            }


            .navbar {
                flex-direction: column;

                gap: 15px;
            }


            .nav-links {
                flex-wrap: wrap;

                justify-content: center;
            }

        }


    </style>

</head>


<body>


<!-- =====================================
     NAVBAR
===================================== -->

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



<!-- =====================================
     BREADCRUMB
===================================== -->

<div class="breadcrumb">

    <a href="{{ route('home') }}">
        Home
    </a>

    &nbsp; / &nbsp;

    <a href="{{ route('products.index') }}">
        Products
    </a>

    &nbsp; / &nbsp;

    {{ $product->name }}

</div>



<!-- =====================================
     PRODUCT DETAILS
===================================== -->

<div class="container">


    <div class="product-container">


        <!-- =================================
             PRODUCT IMAGE
        ================================== -->

        <div class="product-image-container">


            @if($product->image)

                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="product-image"
                >

            @else

                <div class="no-image">

                    No Product Image

                </div>

            @endif


        </div>



        <!-- =================================
             PRODUCT INFORMATION
        ================================== -->

        <div class="product-info">


            <!-- Category -->

            @if($product->category)

                <span class="category">

                    {{ $product->category->name }}

                </span>

            @endif


            <!-- Product Name -->

            <h1 class="product-name">

                {{ $product->name }}

            </h1>


            <!-- SKU -->

            <div class="sku">

                SKU:
                <strong>
                    {{ $product->sku }}
                </strong>

            </div>


            <!-- Price -->

            <div class="price-section">


                @if($product->discount_price)

                    <span class="old-price">

                        ₹{{ number_format($product->price, 2) }}

                    </span>


                    <span class="current-price">

                        ₹{{ number_format($product->discount_price, 2) }}

                    </span>


                    @php

                        $discount = (
                            (
                                $product->price -
                                $product->discount_price
                            )
                            /
                            $product->price
                        ) * 100;

                    @endphp


                    <span class="discount">

                        {{ round($discount) }}% OFF

                    </span>


                @else

                    <span class="current-price">

                        ₹{{ number_format($product->price, 2) }}

                    </span>

                @endif


            </div>



            <!-- Description -->

            <div class="description">


                <h3>
                    Description
                </h3>


                @if($product->description)

                    <p>

                        {{ $product->description }}

                    </p>

                @else

                    <p>

                        No description available.

                    </p>

                @endif


            </div>



            <!-- Stock -->

            <div class="stock">

                Available Stock:

                <span class="stock-available">

                    {{ $product->stock }}

                </span>

            </div>



            <!-- =================================
                 QUANTITY
            ================================== -->

            <div class="quantity-section">


                <label for="quantity">

                    Quantity

                </label>


                <input
                    type="number"
                    id="quantity"
                    name="quantity"
                    value="1"
                    min="1"
                    max="{{ $product->stock }}"
                    class="quantity"
                >


            </div>



            <!-- =================================
                 BUTTONS
            ================================== -->

            <div class="buttons">


                <!-- Add Cart -->

                <form
                    method="POST"
                    action="{{ route('cart.add', $product->id) }}"
                >
                    @csrf

                    <input
                        type="hidden"
                        name="quantity"
                        id="cart-quantity"
                        value="1"
                    >

                    <button
                        type="submit"
                        class="add-cart"
                    >
                        🛒 Add to Cart
                    </button>
                </form>

                <!-- Back -->

                <a
                    href="{{ route('products.index') }}"
                    class="back-btn"
                >

                    ← Back to Products

                </a>


            </div>



            <!-- =================================
                 FEATURES
            ================================== -->

            <div class="features">


                <div class="feature">

                    <span class="feature-icon">
                        🚚
                    </span>

                    <span>
                        Fast & Reliable Delivery
                    </span>

                </div>


                <div class="feature">

                    <span class="feature-icon">
                        🔒
                    </span>

                    <span>
                        Secure Payment
                    </span>

                </div>


                <div class="feature">

                    <span class="feature-icon">
                        🔄
                    </span>

                    <span>
                        Easy Returns
                    </span>

                </div>


            </div>


        </div>


    </div>


</div>



<!-- =====================================
     FOOTER
===================================== -->

<footer class="footer">


    <h2>
        🛍️ My E-Commerce
    </h2>


    <p>

        Your trusted online shopping destination.

    </p>


    <p>

        © {{ date('Y') }}
        My E-Commerce.
        All rights reserved.

    </p>


</footer>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Products - My E-Commerce</title>


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
           PAGE HEADER
        ========================= */

        .page-header {
            background: white;

            padding: 40px 20px;

            text-align: center;

            border-bottom: 1px solid #ddd;
        }


        .page-header h1 {
            font-size: 36px;

            margin-bottom: 10px;
        }


        .page-header p {
            color: #666;
        }


        /* =========================
           CONTAINER
        ========================= */

        .container {
            width: 90%;

            max-width: 1200px;

            margin: 40px auto;
        }


        /* =========================
           FILTER
        ========================= */

        .filter-box {
            background: white;

            padding: 20px;

            border-radius: 10px;

            margin-bottom: 35px;

            box-shadow:
                0 2px 8px
                rgba(0, 0, 0, 0.06);
        }


        .filter-form {
            display: grid;

            grid-template-columns:
                2fr 1fr auto;

            gap: 15px;
        }


        .filter-form input,
        .filter-form select {
            width: 100%;

            padding: 12px;

            border: 1px solid #ccc;

            border-radius: 6px;

            font-size: 15px;
        }


        .search-btn {
            padding: 12px 25px;

            border: none;

            background: #111;

            color: white;

            border-radius: 6px;

            cursor: pointer;

            font-size: 15px;
        }


        .search-btn:hover {
            background: #333;
        }


        .clear-btn {
            display: inline-block;

            margin-top: 12px;

            color: #2563eb;

            text-decoration: none;

            font-size: 14px;
        }


        /* =========================
           RESULT INFO
        ========================= */

        .result-info {
            margin-bottom: 20px;

            color: #555;
        }


        /* =========================
           PRODUCTS
        ========================= */

        .products {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 25px;
        }


        .product-card {
            background: white;

            border-radius: 10px;

            overflow: hidden;

            box-shadow:
                0 3px 12px
                rgba(0, 0, 0, 0.08);

            transition: 0.2s;
        }


        .product-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 7px 18px
                rgba(0, 0, 0, 0.12);
        }


        /* =========================
           PRODUCT IMAGE
        ========================= */

        .image-container {
            width: 100%;

            height: 240px;

            background: #f1f1f1;

            display: flex;

            align-items: center;

            justify-content: center;
        }


        .product-image {
            width: 100%;

            height: 240px;

            object-fit: cover;
        }


        .no-image {
            color: #777;

            font-size: 15px;
        }


        /* =========================
           PRODUCT INFO
        ========================= */

        .product-info {
            padding: 18px;
        }


        .product-name {
            font-size: 19px;

            margin-bottom: 8px;

            font-weight: bold;
        }


        .category {
            color: #777;

            font-size: 14px;

            margin-bottom: 12px;
        }


        /* =========================
           PRICE
        ========================= */

        .price-box {
            margin: 15px 0;
        }


        .old-price {
            color: #999;

            text-decoration: line-through;

            font-size: 14px;

            margin-right: 8px;
        }


        .current-price {
            font-size: 21px;

            font-weight: bold;
        }


        .discount {
            display: inline-block;

            margin-left: 7px;

            background: #dc2626;

            color: white;

            padding: 4px 7px;

            border-radius: 4px;

            font-size: 11px;
        }


        /* =========================
           STOCK
        ========================= */

        .stock {
            color: #16a34a;

            font-size: 14px;

            margin-bottom: 15px;
        }


        /* =========================
           VIEW BUTTON
        ========================= */

        .view-btn {
            display: block;

            width: 100%;

            text-align: center;

            background: #111;

            color: white;

            text-decoration: none;

            padding: 11px;

            border-radius: 6px;
        }


        .view-btn:hover {
            background: #333;
        }


        /* =========================
           EMPTY
        ========================= */

        .empty {
            background: white;

            padding: 60px 20px;

            text-align: center;

            border-radius: 10px;

            color: #666;
        }


        .empty h2 {
            margin-bottom: 10px;

            color: #222;
        }


        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            margin-top: 40px;

            display: flex;

            justify-content: center;
        }


        /* =========================
           FOOTER
        ========================= */

        .footer {
            background: #111;

            color: white;

            text-align: center;

            padding: 40px 20px;

            margin-top: 80px;
        }


        .footer p {
            color: #aaa;

            margin-top: 10px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 1000px) {

            .products {
                grid-template-columns:
                    repeat(3, 1fr);
            }

        }


        @media (max-width: 750px) {

            .products {
                grid-template-columns:
                    repeat(2, 1fr);
            }


            .filter-form {
                grid-template-columns: 1fr;
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


        @media (max-width: 500px) {

            .products {
                grid-template-columns: 1fr;
            }


            .page-header h1 {
                font-size: 28px;
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

            @if(auth()->user()->role === 'admin')

                <a href="{{ route('admin.dashboard') }}">
                    Admin
                </a>

            @elseif(auth()->user()->role === 'seller')

                <a href="{{ route('seller.dashboard') }}">
                    Seller
                </a>

            @else

                <a href="{{ route('customer.dashboard') }}">
                    My Account
                </a>

            @endif

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
     PAGE HEADER
===================================== -->

<section class="page-header">

    <h1>
        All Products
    </h1>

    <p>
        Discover our latest products and best deals.
    </p>

</section>



<!-- =====================================
     MAIN
===================================== -->

<div class="container">


    <!-- =================================
         SEARCH & FILTER
    ================================== -->

    <div class="filter-box">


        <form
            action="{{ route('products.index') }}"
            method="GET"
            class="filter-form"
        >


            <!-- Search -->

            <input
                type="text"
                name="search"
                placeholder="Search products..."
                value="{{ request('search') }}"
            >


            <!-- Category -->

            <select name="category_id">


                <option value="">
                    All Categories
                </option>


                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"

                        {{ request('category_id') == $category->id ? 'selected' : '' }}
                    >

                        {{ $category->name }}

                    </option>

                @endforeach


            </select>


            <!-- Search Button -->

            <button
                type="submit"
                class="search-btn"
            >

                🔍 Search

            </button>


        </form>



        @if(request('search') || request('category_id'))

            <a
                href="{{ route('products.index') }}"
                class="clear-btn"
            >

                ✕ Clear Filters

            </a>

        @endif


    </div>



    <!-- =================================
         RESULT COUNT
    ================================== -->

    <div class="result-info">

        Showing
        <strong>{{ $products->count() }}</strong>
        products on this page.

    </div>



    <!-- =================================
         PRODUCTS
    ================================== -->

    @if($products->count() > 0)


        <div class="products">


            @foreach($products as $product)


                <div class="product-card">


                    <!-- IMAGE -->

                    <div class="image-container">


                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="product-image"
                            >

                        @else

                            <span class="no-image">

                                No Image

                            </span>

                        @endif


                    </div>



                    <!-- INFO -->

                    <div class="product-info">


                        <!-- NAME -->

                        <h3 class="product-name">

                            {{ $product->name }}

                        </h3>


                        <!-- CATEGORY -->

                        @if($product->category)

                            <div class="category">

                                Category:

                                {{ $product->category->name }}

                            </div>

                        @endif



                        <!-- PRICE -->

                        <div class="price-box">


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



                        <!-- STOCK -->

                        <div class="stock">

                            ✓
                            {{ $product->stock }}
                            items available

                        </div>



                        <!-- VIEW PRODUCT -->

                        <a
                            href="{{ route('products.show', $product->id) }}"
                            class="view-btn"
                        >

                            View Product

                        </a>


                    </div>


                </div>


            @endforeach


        </div>


    @else


        <!-- EMPTY -->

        <div class="empty">

            <h2>
                No Products Found
            </h2>

            <p>
                Try changing your search or category filter.
            </p>

            <br>

            <a
                href="{{ route('products.index') }}"
                class="view-btn"
                style="display:inline-block; width:auto;"
            >

                View All Products

            </a>

        </div>


    @endif



    <!-- =================================
         PAGINATION
    ================================== -->

    @if($products->hasPages())

        <div class="pagination">

            {{ $products->links() }}

        </div>

    @endif


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
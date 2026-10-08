<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'E-Commerce')
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            background: #222;
            padding: 18px 40px;
        }

        .navbar {
            max-width: 1200px;
            margin: auto;

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .nav-links a:hover {
            color: #ddd;
        }

        .login-btn {
            padding: 8px 15px;
            border-radius: 5px;
            background: #198754;
        }

        .register-btn {
            padding: 8px 15px;
            border-radius: 5px;
            background: #0d6efd;
        }

        /* =========================
           MAIN
        ========================= */

        .main-content {
            min-height: 70vh;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            background: #222;
            color: white;
            padding: 30px;
            margin-top: 50px;
        }

        .footer-content {
            max-width: 1200px;
            margin: auto;

            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .footer h3 {
            margin-top: 0;
        }

        .footer p {
            color: #ccc;
        }

        .footer-bottom {
            text-align: center;
            border-top: 1px solid #444;
            margin-top: 25px;
            padding-top: 15px;
            color: #aaa;
        }

    </style>

    @stack('styles')

</head>


<body>


    {{-- =========================
         HEADER
    ========================= --}}

    <header class="header">

        <div class="navbar">


            {{-- Logo --}}

            <div class="logo">

                <a href="{{ route('home') }}">
                    My E-Commerce
                </a>

            </div>


            {{-- Navigation --}}

            <div class="nav-links">


                <a href="{{ route('home') }}">
                    Home
                </a>


                <a href="{{ route('products.index') }}">
                    Products
                </a>


                {{-- Cart --}}

                <a href="{{ route('cart.index') }}">

                    🛒 Cart

                    @php

                        $cart = session()->get(
                            'cart',
                            []
                        );

                        $cartCount = collect($cart)
                            ->sum('quantity');

                    @endphp


                    @if($cartCount > 0)

                        ({{ $cartCount }})

                    @endif

                </a>


                @auth

                    @if(auth()->user()->role === 'admin')

                        <a
                            href="{{ route('admin.dashboard') }}"
                        >
                            Admin
                        </a>


                    @elseif(auth()->user()->role === 'seller')

                        <a
                            href="{{ route('seller.dashboard') }}"
                        >
                            Seller
                        </a>


                    @else

                        <a
                            href="{{ route('customer.dashboard') }}"
                        >
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

        </div>

    </header>


    {{-- =========================
         MAIN CONTENT
    ========================= --}}

    <main class="main-content">

        @yield('content')

    </main>


    {{-- =========================
         FOOTER
    ========================= --}}

    <footer class="footer">

        <div class="footer-content">


            <div>

                <h3>
                    My E-Commerce
                </h3>

                <p>
                    Simple Laravel E-Commerce Management System.
                </p>

            </div>


            <div>

                <h3>
                    Quick Links
                </h3>

                <p>
                    <a
                        href="{{ route('home') }}"
                        style="color:white;"
                    >
                        Home
                    </a>
                </p>

                <p>
                    <a
                        href="{{ route('products.index') }}"
                        style="color:white;"
                    >
                        Products
                    </a>
                </p>

            </div>


            <div>

                <h3>
                    Contact
                </h3>

                <p>
                    Email: support@example.com
                </p>

                <p>
                    Phone: +91 9876543210
                </p>

            </div>


        </div>


        <div class="footer-bottom">

            © {{ date('Y') }}
            My E-Commerce.
            All rights reserved.

        </div>

    </footer>


    @stack('scripts')

</body>

</html>
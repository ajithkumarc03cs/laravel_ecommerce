@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container">

    {{-- Hero --}}

    <section class="hero">

        <h1>
            Welcome to My E-Commerce
        </h1>

        <p>
            Find the best products at the best prices.
        </p>

        <a href="{{ route('products.index') }}">
            Shop Now
        </a>

    </section>


    {{-- Categories --}}

    <section>

        <h2>
            Categories
        </h2>

        <div class="category-grid">

            @foreach($categories as $category)

                <div class="category-card">

                    <h3>
                        {{ $category->name }}
                    </h3>

                    @if($category->description)

                        <p>
                            {{ $category->description }}
                        </p>

                    @endif

                </div>

            @endforeach

        </div>

    </section>


    {{-- Latest Products --}}

    <section>

        <h2>
            Latest Products
        </h2>

        @if($products->count() > 0)

            <div class="product-grid">

                @foreach($products as $product)

                    <div class="product-card">

                        @if($product->image)

                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                            >

                        @else

                            <div class="no-image">
                                No Image
                            </div>

                        @endif


                        <div class="product-content">

                            <h3>
                                {{ $product->name }}
                            </h3>


                            @if($product->category)

                                <p>
                                    {{ $product->category->name }}
                                </p>

                            @endif


                            @if($product->discount_price)

                                <span class="old-price">

                                    ₹{{ number_format(
                                        $product->price,
                                        2
                                    ) }}

                                </span>

                                <strong>

                                    ₹{{ number_format(
                                        $product->discount_price,
                                        2
                                    ) }}

                                </strong>

                            @else

                                <strong>

                                    ₹{{ number_format(
                                        $product->price,
                                        2
                                    ) }}

                                </strong>

                            @endif


                            <br><br>


                            <a
                                href="{{ route(
                                    'products.show',
                                    $product->id
                                ) }}"
                            >
                                View Product
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <p>
                No products available.
            </p>

        @endif


        <div class="view-all">

            <a href="{{ route('products.index') }}">
                View All Products →
            </a>

        </div>

    </section>

</div>

@endsection


@push('styles')

<style>

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .hero {
        background: #222;
        color: white;
        padding: 70px 30px;
        text-align: center;
        border-radius: 12px;
        margin-bottom: 50px;
    }

    .hero h1 {
        font-size: 40px;
        margin-bottom: 15px;
    }

    .hero p {
        font-size: 18px;
        margin-bottom: 25px;
    }

    .hero a {
        display: inline-block;
        background: #198754;
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 6px;
    }

    section {
        margin-bottom: 50px;
    }

    section h2 {
        margin-bottom: 25px;
    }

    .category-grid,
    .product-grid {
        display: grid;
        grid-template-columns:
            repeat(auto-fit, minmax(220px, 1fr));

        gap: 20px;
    }

    .category-card,
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        padding: 20px;
    }

    .category-card {
        text-align: center;
    }

    .product-card {
        padding: 0;
    }

    .product-card img,
    .no-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .no-image {
        background: #eee;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-content {
        padding: 20px;
    }

    .product-content a {
        display: inline-block;
        padding: 10px 15px;
        background: #198754;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .old-price {
        color: #999;
        text-decoration: line-through;
        margin-right: 8px;
    }

    .view-all {
        text-align: center;
        margin-top: 30px;
    }

    .view-all a {
        text-decoration: none;
    }

</style>

@endpush
@extends('layouts.app')

@section('title', 'Products')

@section('content')

<div class="container">

    <h1>Products</h1>


    {{-- Filters --}}

    <div class="filters">

        <form
            method="GET"
            action="{{ route('products.index') }}"
        >

            <input
                type="text"
                name="search"
                placeholder="Search product..."
                value="{{ request('search') }}"
            >


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


            <button type="submit">
                Search
            </button>


            <a
                href="{{ route('products.index') }}"
            >
                Clear
            </a>

        </form>

    </div>


    {{-- Products --}}

    @if($products->count() > 0)

        <div class="products">

            @foreach($products as $product)

                <div class="product-card">


                    {{-- Product Image --}}

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


                        {{-- Product Name --}}

                        <h3>
                            {{ $product->name }}
                        </h3>


                        {{-- Category --}}

                        @if($product->category)

                            <p class="category">

                                {{ $product->category->name }}

                            </p>

                        @endif


                        {{-- Price --}}

                        <div class="price">

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

                        </div>


                        {{-- Stock --}}

                        <p>
                            Stock:
                            {{ $product->stock }}
                        </p>


                        {{-- View Product --}}

                        <a
                            href="{{ route(
                                'products.show',
                                $product->id
                            ) }}"
                            class="view-btn"
                        >
                            View Product
                        </a>


                    </div>

                </div>

            @endforeach

        </div>


        {{-- Pagination --}}

        <div class="pagination">

            {{ $products->links() }}

        </div>


    @else

        <div class="empty">

            <h2>
                No Products Found
            </h2>

            <p>
                Try another search or category.
            </p>

        </div>

    @endif

</div>

@endsection


@push('styles')

<style>

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }


    .filters {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }


    .filters input,
    .filters select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }


    .filters button {
        padding: 10px 18px;
        border: none;
        background: #198754;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }


    .filters a {
        margin-left: 10px;
        text-decoration: none;
    }


    .products {
        display: grid;

        grid-template-columns:
            repeat(
                auto-fit,
                minmax(220px, 1fr)
            );

        gap: 20px;
    }


    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
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


    .product-content h3 {
        margin-top: 0;
    }


    .category {
        color: #777;
        font-size: 14px;
    }


    .price {
        margin: 15px 0;
        font-size: 18px;
    }


    .old-price {
        color: #999;
        text-decoration: line-through;
        margin-right: 8px;
    }


    .view-btn {
        display: inline-block;
        padding: 10px 15px;
        background: #198754;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }


    .pagination {
        margin-top: 30px;
    }


    .empty {
        background: white;
        padding: 40px;
        text-align: center;
        border-radius: 10px;
    }


    @media(max-width: 768px) {

        .filters input,
        .filters select,
        .filters button {
            width: 100%;
            margin: 5px 0;
        }

    }

</style>

@endpush
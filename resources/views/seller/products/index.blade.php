<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Products</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .container {
            width: 95%;
            max-width: 1400px;
            margin: 30px auto;
        }

        h1 {
            text-align: center;
        }

        .top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .top a {
            text-decoration: none;
            color: #0d6efd;
            font-weight: bold;
        }

        .filter-box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .filter-row {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        input,
        select {
            padding: 8px;
            min-width: 180px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 9px 15px;
            cursor: pointer;
            border-radius: 4px;
        }

        .search-btn {
            background: black;
            color: white;
            border: none;
        }

        .reset-btn {
            text-decoration: none;
            padding: 9px 15px;
            background: #ddd;
            color: black;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #222;
            color: white;
        }

        .success {
            color: green;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        .product-image {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .active {
            color: green;
            font-weight: bold;
        }

        .inactive {
            color: red;
            font-weight: bold;
        }

        .edit-btn {
            color: #0d6efd;
            text-decoration: none;
            margin-right: 10px;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
            border: none;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {

            .top {
                flex-direction: column;
                gap: 15px;
            }

            table {
                min-width: 1000px;
            }

            .table-wrapper {
                overflow-x: auto;
            }

        }

    </style>

</head>


<body>


<div class="container">


    <h1>My Products</h1>


    {{-- Success Message --}}

    @if(session('success'))

        <p class="success">
            {{ session('success') }}
        </p>

    @endif


    {{-- Error Message --}}

    @if(session('error'))

        <p class="error">
            {{ session('error') }}
        </p>

    @endif


    {{-- Top Links --}}

    <div class="top">

        <a href="{{ route('seller.dashboard') }}">
            ← Seller Dashboard
        </a>

        <a href="{{ route('seller.products.create') }}">
            + Add Product
        </a>

    </div>


    {{-- Search and Filter --}}

    <div class="filter-box">

        <form
            action="{{ route('seller.products.index') }}"
            method="GET"
        >

            <div class="filter-row">


                {{-- Search --}}

                <div class="filter-group">

                    <label>
                        Search Product
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Enter product name"
                    >

                </div>


                {{-- Category --}}

                <div class="filter-group">

                    <label>
                        Category
                    </label>

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

                </div>


                {{-- Status --}}

                <div class="filter-group">

                    <label>
                        Status
                    </label>

                    <select name="status">

                        <option value="">
                            All Status
                        </option>

                        <option
                            value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}
                        >
                            Active
                        </option>

                        <option
                            value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}
                        >
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Search Button --}}

                <div class="filter-group">

                    <button
                        type="submit"
                        class="search-btn"
                    >
                        Search
                    </button>

                </div>


                {{-- Reset --}}

                <div class="filter-group">

                    <a
                        href="{{ route('seller.products.index') }}"
                        class="reset-btn"
                    >
                        Reset
                    </a>

                </div>


            </div>

        </form>

    </div>


    {{-- Products Table --}}

    <div class="table-wrapper">

        <table>

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Image</th>

                    <th>Name</th>

                    <th>Category</th>

                    <th>Price</th>

                    <th>Stock</th>

                    <th>SKU</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>

                @forelse($products as $product)

                    <tr>


                        {{-- ID --}}

                        <td>
                            {{ $product->id }}
                        </td>


                        {{-- Image --}}

                        <td>

                            @if($product->image)

                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    class="product-image"
                                    alt="{{ $product->name }}"
                                >

                            @else

                                No Image

                            @endif

                        </td>


                        {{-- Name --}}

                        <td>
                            {{ $product->name }}
                        </td>


                        {{-- Category --}}

                        <td>
                            {{ $product->category->name ?? 'No Category' }}
                        </td>


                        {{-- Price --}}

                        <td>
                            ₹{{ number_format($product->price, 2) }}
                        </td>


                        {{-- Stock --}}

                        <td>
                            {{ $product->stock }}
                        </td>


                        {{-- SKU --}}

                        <td>
                            {{ $product->sku }}
                        </td>


                        {{-- Status --}}

                        <td>

                            @if($product->status)

                                <span class="active">
                                    Active
                                </span>

                            @else

                                <span class="inactive">
                                    Inactive
                                </span>

                            @endif

                        </td>


                        {{-- Action --}}

                        <td>

                            <a
                                href="{{ route('seller.products.edit', $product->id) }}"
                                class="edit-btn"
                            >
                                Edit
                            </a>


                            <form
                                action="{{ route('seller.products.destroy', $product->id) }}"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Delete this product?');"
                            >

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-btn"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>


                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="9"
                            style="text-align:center;"
                        >
                            No products found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}

    <div class="pagination">

        {{ $products->links() }}

    </div>


</div>


</body>

</html>
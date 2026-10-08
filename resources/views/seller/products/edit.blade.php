<!DOCTYPE html>
<html>

<head>

    <title>Edit Product</title>

</head>

<body>

    <h1>Edit Product</h1>

    <a href="{{ route('seller.products.index') }}">
        ← Back to My Products
    </a>

    <br><br>


    {{-- Validation Errors --}}

    @if($errors->any())

        <div style="color: red;">

            <strong>Please fix the following errors:</strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('seller.products.update', $product->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        {{-- Product Name --}}

        <div>

            <label>
                Product Name
            </label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
                placeholder="Enter product name"
            >

        </div>

        <br>


        {{-- Category --}}

        <div>

            <label>
                Category
            </label>

            <br>

            <select name="category_id">

                <option value="">
                    -- Select Category --
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <br>


        {{-- Description --}}

        <div>

            <label>
                Description
            </label>

            <br>

            <textarea
                name="description"
                rows="5"
                cols="40"
                placeholder="Enter product description"
            >{{ old('description', $product->description) }}</textarea>

        </div>

        <br>


        {{-- Price --}}

        <div>

            <label>
                Price
            </label>

            <br>

            <input
                type="number"
                name="price"
                step="0.01"
                value="{{ old('price', $product->price) }}"
                placeholder="Enter price"
            >

        </div>

        <br>


        {{-- Discount Price --}}

        <div>

            <label>
                Discount Price
            </label>

            <br>

            <input
                type="number"
                name="discount_price"
                step="0.01"
                value="{{ old('discount_price', $product->discount_price) }}"
                placeholder="Enter discount price"
            >

        </div>

        <br>


        {{-- Stock --}}

        <div>

            <label>
                Stock
            </label>

            <br>

            <input
                type="number"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
                placeholder="Enter stock"
            >

        </div>

        <br>


        {{-- SKU --}}

        <div>

            <label>
                SKU
            </label>

            <br>

            <input
                type="text"
                name="sku"
                value="{{ old('sku', $product->sku) }}"
                placeholder="Enter SKU"
            >

        </div>

        <br>


        {{-- Current Image --}}

        <div>

            <label>
                Current Image
            </label>

            <br>

            @if($product->image)

                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    width="150"
                    height="150"
                    style="object-fit: cover;"
                >

            @else

                <p>
                    No image uploaded.
                </p>

            @endif

        </div>

        <br>


        {{-- New Image --}}

        <div>

            <label>
                Change Product Image
            </label>

            <br>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
            >

            <br>

            <small>
                Leave empty if you don't want to change the image.
            </small>

        </div>

        <br>


        {{-- Status --}}

        <div>

            <label>
                Status
            </label>

            <br>

            <select name="status">

                <option
                    value="1"
                    {{ old('status', $product->status) == 1 ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ old('status', $product->status) == 0 ? 'selected' : '' }}
                >
                    Inactive
                </option>

            </select>

        </div>

        <br>


        {{-- Submit --}}

        <button type="submit">
            Update Product
        </button>

    </form>

</body>

</html>
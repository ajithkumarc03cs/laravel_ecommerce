<!DOCTYPE html>
<html>

<head>

    <title>Add Product</title>

</head>

<body>

    <h1>Add Product</h1>

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
        action="{{ route('seller.products.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        {{-- Product Name --}}

        <div>

            <label>
                Product Name
            </label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
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
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
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
            >{{ old('description') }}</textarea>

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
                min="0"
                value="{{ old('price') }}"
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
                min="0"
                value="{{ old('discount_price') }}"
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
                min="0"
                value="{{ old('stock', 0) }}"
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
                value="{{ old('sku') }}"
                placeholder="Enter SKU"
            >

        </div>

        <br>


        {{-- Product Image --}}

        <div>

            <label>
                Product Image
            </label>

            <br>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/jpg,image/webp"
            >

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
                    {{ old('status', 1) == 1 ? 'selected' : '' }}
                >
                    Active
                </option>

                <option
                    value="0"
                    {{ old('status') === '0' ? 'selected' : '' }}
                >
                    Inactive
                </option>

            </select>

        </div>

        <br>


        {{-- Submit --}}

        <button type="submit">
            Create Product
        </button>

    </form>

</body>

</html>
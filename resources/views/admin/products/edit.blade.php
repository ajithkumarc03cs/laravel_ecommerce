@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Product</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 95%;
            max-width: 800px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0;
        }

        .back-btn {
            text-decoration: none;
            background: #333;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .back-btn:hover {
            background: #555;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        .error-box {
            background: #f8d7da;
            color: #842029;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .current-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .help-text {
            color: #777;
            font-size: 13px;
            margin-top: 5px;
        }

        .required {
            color: red;
        }

        .update-btn {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .update-btn:hover {
            background: #0b5ed7;
        }

        .cancel-btn {
            display: inline-block;
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            margin-left: 10px;
        }

        .cancel-btn:hover {
            background: #5c636a;
        }

    </style>

</head>


<body>


<div class="container">


    {{-- Header --}}

    <div class="header">

        <h1>Edit Product</h1>

        <a
            href="{{ route('admin.products.index') }}"
            class="back-btn"
        >
            ← Back to Products
        </a>

    </div>


    {{-- Validation Errors --}}

    @if($errors->any())

        <div class="error-box">

            <strong>
                Please fix the following errors:
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Edit Product Form --}}

    <div class="form-box">

        <form
            action="{{ route('admin.products.update', $product->id) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            {{-- Product Name --}}

            <div class="form-group">

                <label>
                    Product Name
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name) }}"
                    placeholder="Enter product name"
                >

            </div>


            {{-- Description --}}

            <div class="form-group">

                <label>
                    Description
                </label>

                <textarea
                    name="description"
                    rows="6"
                    placeholder="Enter product description"
                >{{ old('description', $product->description) }}</textarea>

            </div>


            {{-- Category --}}

            <div class="form-group">

                <label>
                    Category
                    <span class="required">*</span>
                </label>

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


            {{-- Price --}}

            <div class="form-group">

                <label>
                    Price
                    <span class="required">*</span>
                </label>

                <input
                    type="number"
                    name="price"
                    step="0.01"
                    min="0"
                    value="{{ old('price', $product->price) }}"
                    placeholder="Enter price"
                >

            </div>


            {{-- Discount Price --}}

            <div class="form-group">

                <label>
                    Discount Price
                </label>

                <input
                    type="number"
                    name="discount_price"
                    step="0.01"
                    min="0"
                    value="{{ old('discount_price', $product->discount_price) }}"
                    placeholder="Enter discount price"
                >

                <div class="help-text">
                    Leave empty if there is no discount.
                </div>

            </div>


            {{-- Stock --}}

            <div class="form-group">

                <label>
                    Stock
                    <span class="required">*</span>
                </label>

                <input
                    type="number"
                    name="stock"
                    min="0"
                    value="{{ old('stock', $product->stock) }}"
                    placeholder="Enter stock"
                >

            </div>


            {{-- SKU --}}

            <div class="form-group">

                <label>
                    SKU
                </label>

                <input
                    type="text"
                    value="{{ $product->sku }}"
                    readonly
                >

                <div class="help-text">
                    SKU cannot be changed.
                </div>

            </div>


            {{-- Current Image --}}

            <div class="form-group">

                <label>
                    Current Product Image
                </label>

                @if($product->image)

                    <br>

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="current-image"
                    >

                @else

                    <p>
                        No image available.
                    </p>

                @endif

            </div>


            {{-- New Image --}}

            <div class="form-group">

                <label>
                    Change Product Image
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                >

                <div class="help-text">
                    JPG, JPEG, PNG, WEBP. Maximum 2MB.
                </div>

            </div>


            {{-- Status --}}

            <div class="form-group">

                <label>
                    Status
                    <span class="required">*</span>
                </label>

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


            {{-- Buttons --}}

            <button
                type="submit"
                class="update-btn"
            >
                Update Product
            </button>


            <a
                href="{{ route('admin.products.index') }}"
                class="cancel-btn"
            >
                Cancel
            </a>


        </form>

    </div>


</div>


</body>

</html>
@endsection
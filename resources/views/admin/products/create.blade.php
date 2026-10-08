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

    <title>Add Product</title>


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

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #0d6efd;
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

        .required {
            color: red;
        }

        .help-text {
            color: #777;
            font-size: 13px;
            margin-top: 5px;
        }

        .submit-btn {
            background: #198754;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-btn:hover {
            background: #157347;
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

        <h1>Add Product</h1>

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


    {{-- Product Form --}}

    <div class="form-box">

        <form
            action="{{ route('admin.products.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            {{-- Product Name --}}

            <div class="form-group">

                <label>
                    Product Name
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter product name"
                >

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
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

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
                >{{ old('description') }}</textarea>

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
                    value="{{ old('price') }}"
                    placeholder="Enter product price"
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
                    value="{{ old('discount_price') }}"
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
                    value="{{ old('stock', 0) }}"
                    placeholder="Enter stock quantity"
                >

            </div>


            {{-- Product Image --}}

            <div class="form-group">

                <label>
                    Product Image
                </label>

                <input
                    type="file"
                    name="image"
                    accept="image/jpeg,image/png,image/jpg,image/webp"
                >

                <div class="help-text">
                    Allowed: JPG, JPEG, PNG, WEBP. Maximum 2MB.
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


            {{-- Buttons --}}

            <button
                type="submit"
                class="submit-btn"
            >
                Create Product
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
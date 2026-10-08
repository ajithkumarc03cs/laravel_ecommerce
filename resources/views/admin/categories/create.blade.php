@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>

<body>

    <h1>Add Category</h1>

    @if($errors->any())

        <div style="color:red;">

            @foreach($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif

    <form
        action="{{ route('admin.categories.store') }}"
        method="POST"
    >

        @csrf

        <div>
            <label>Category Name</label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Description</label>

            <br>

            <textarea
                name="description"
                rows="5"
                cols="40"
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <div>

            <label>Status</label>

            <br>

            <select name="status">

                <option value="1">
                    Active
                </option>

                <option value="0">
                    Inactive
                </option>

            </select>

        </div>

        <br>

        <button type="submit">
            Save Category
        </button>

        <a href="{{ route('admin.categories.index') }}">
            Cancel
        </a>

    </form>

</body>
</html>
@endsection
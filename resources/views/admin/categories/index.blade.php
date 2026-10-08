@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .add-btn {
            display: inline-block;
            padding: 10px 15px;
            background: black;
            color: white;
            text-decoration: none;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
        }

        th {
            background: #f2f2f2;
        }

        .active {
            color: green;
        }

        .inactive {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Manage Categories</h1>

    @if(session('success'))
        <p class="success">
            {{ session('success') }}
        </p>
    @endif

    @if($errors->any())
        <div class="error">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.categories.create') }}" class="add-btn">
        + Add Category
    </a>

    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @forelse($categories as $category)

                <tr>

                    <td>{{ $category->id }}</td>

                    <td>{{ $category->name }}</td>

                    <td>{{ $category->slug }}</td>

                    <td>
                        {{ $category->description ?? '-' }}
                    </td>

                    <td>

                        @if($category->status)
                            <span class="active">Active</span>
                        @else
                            <span class="inactive">Inactive</span>
                        @endif

                    </td>

                    <td>
                        {{ $category->created_at }}
                    </td>

                    <td>

                        <a href="{{ route('admin.categories.edit', $category->id) }}">
                            Edit
                        </a>

                        |

                        <form
                            action="{{ route('admin.categories.destroy', $category->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Delete this category?');"
                        >

                            @csrf

                            @method('DELETE')

                            <button type="submit">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7">
                        No categories found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <br>

    {{ $categories->links() }}

</div>

</body>
</html>
@endsection

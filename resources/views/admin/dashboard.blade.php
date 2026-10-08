@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="dashboard-container">

    <h1>Admin Dashboard</h1>

    <p>
        Welcome,
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    <div class="dashboard-cards">

        <div class="card">
            <h3>Users</h3>
            <a href="{{ route('admin.users.index') }}">
                Manage Users
            </a>
        </div>

        <div class="card">
            <h3>Categories</h3>
            <a href="{{ route('admin.categories.index') }}">
                Manage Categories
            </a>
        </div>

        <div class="card">
            <h3>Products</h3>
            <a href="{{ route('admin.products.index') }}">
                Manage Products
            </a>
        </div>

    </div>

</div>

@endsection
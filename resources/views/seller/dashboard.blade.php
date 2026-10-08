@extends('layouts.app')

@section('title', 'Seller Dashboard')

@section('content')

<div style="max-width: 1000px; margin: 40px auto; padding: 20px;">

    <h1>Seller Dashboard</h1>

    <p>
        Welcome Seller!
    </p>

    <p>
        Logged in as:
        <strong>{{ auth()->user()->name }}</strong>
    </p>

    <p>
        Email:
        <strong>{{ auth()->user()->email }}</strong>
    </p>

    <hr>

    <h2>Seller Menu</h2>

    <p>
        <a href="{{ route('seller.products.index') }}">
            Manage My Products
        </a>
    </p>

    <p>
        <a href="{{ route('seller.products.create') }}">
            + Add Product
        </a>
    </p>
    <form action="{{ route('logout') }}" method="POST">

     @csrf

     <button type="submit">
           Logout
     </button>

     </form>

</div>

@endsection
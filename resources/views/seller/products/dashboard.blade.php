<!DOCTYPE html>
<html>

<head>
    <title>Seller Dashboard</title>
</head>

<body>

    <h1>Seller Dashboard</h1>

    <p>
        Welcome Seller!
    </p>

    <p>
        Logged in as:
        {{ auth()->user()->name }}
    </p>

    <hr>

    <a href="{{ route('seller.products.index') }}">
        Manage My Products
    </a>

    <br><br>

    <a href="{{ route('seller.products.create') }}">
        + Add Product
    </a>

    <br><br>

    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button type="submit">
            Logout
        </button>

    </form>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users</title>

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
            max-width: 1200px;
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
            background: #333;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-btn:hover {
            background: #555;
        }

        .success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border-bottom: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        tr:hover {
            background: #fafafa;
        }

        select {
            padding: 7px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 7px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .update-btn {
            background: #0d6efd;
            color: white;
        }

        .update-btn:hover {
            background: #0b5ed7;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background: #bb2d3b;
        }

        .current-user {
            color: #198754;
            font-weight: bold;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {

            .header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            th,
            td {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        {{-- Header --}}
        <div class="header">

            <h1>Manage Users</h1>

            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                ← Back to Dashboard
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error Message --}}
        @if(session('error'))

            <div class="error">
                {{ session('error') }}
            </div>

        @endif


        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- ID --}}
                            <td>
                                {{ $user->id }}
                            </td>


                            {{-- Name --}}
                            <td>
                                {{ $user->name }}
                            </td>


                            {{-- Email --}}
                            <td>
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td>

                                @if($user->id !== auth()->id())

                                    <form
                                        action="{{ route('admin.users.updateRole', $user->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PUT')


                                        <select name="role">

                                            <option value="admin"
                                                {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>

                                            <option value="seller"
                                                {{ $user->role === 'seller' ? 'selected' : '' }}>
                                                Seller
                                            </option>

                                            <option value="customer"
                                                {{ $user->role === 'customer' ? 'selected' : '' }}>
                                                Customer
                                            </option>

                                        </select>


                                        <button
                                            type="submit"
                                            class="update-btn"
                                        >
                                            Update
                                        </button>

                                    </form>

                                @else

                                    <span class="current-user">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Created At --}}
                            <td>
                                {{ $user->created_at?->format('d-m-Y H:i') }}
                            </td>


                            {{-- Delete --}}
                            <td>

                                @if($user->id !== auth()->id())

                                    <form
                                        action="{{ route('admin.users.destroy', $user->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
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

                                @else

                                    <span class="current-user">
                                        Current User
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" style="text-align:center;">
                                No users found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            {{-- Pagination --}}
            <div class="pagination">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</body>

</html>
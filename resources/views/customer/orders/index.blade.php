@extends('layouts.app')

@section('title', 'My Orders')

@section('content')

<div class="orders-container">

    <h1>My Orders</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)

        @foreach($orders as $order)

            <div class="order-card">

                <div class="order-header">

                    <div>
                        <h3>Order #{{ $order->id }}</h3>

                        <p>
                            {{ $order->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>

                    <div>
                        <span class="status">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                </div>

                <div class="order-details">

                    <p>
                        <strong>Total:</strong>
                        ₹{{ number_format($order->total_amount, 2) }}
                    </p>

                    <p>
                        <strong>Payment:</strong>
                        {{ strtoupper($order->payment_method) }}
                    </p>

                    <p>
                        <strong>Payment Status:</strong>
                        {{ ucfirst($order->payment_status) }}
                    </p>

                </div>

                <a href="{{ route('orders.show', $order) }}"
                   class="view-btn">

                    View Order

                </a>

            </div>

        @endforeach

        <div class="pagination">
            {{ $orders->links() }}
        </div>

    @else

        <div class="empty">

            <h2>No Orders Found</h2>

            <p>You haven't placed any orders yet.</p>

            <a href="{{ route('products.index') }}">
                Start Shopping
            </a>

        </div>

    @endif

</div>

@endsection


@push('styles')

<style>

.orders-container {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
}

.orders-container h1 {
    margin-bottom: 30px;
}

.success {
    background: #d1e7dd;
    color: #0f5132;
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 20px;
}

.order-card {
    background: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
}

.order-header h3 {
    margin: 0;
}

.order-header p {
    color: #777;
}

.status {
    background: #fff3cd;
    color: #664d03;
    padding: 6px 12px;
    border-radius: 20px;
}

.order-details {
    padding: 15px 0;
}

.view-btn {
    display: inline-block;
    background: #0d6efd;
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    text-decoration: none;
}

.empty {
    background: white;
    padding: 50px;
    text-align: center;
    border-radius: 8px;
}

.empty a {
    display: inline-block;
    margin-top: 15px;
    background: #198754;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 5px;
}

</style>

@endpush
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>My Orders</h3>
    <a href="{{ route('affiliate.orders.create') }}" class="btn btn-primary">Create Order</a>
</div>
<table class="table table-striped bg-white">
    <thead><tr><th>#</th><th>Customer</th><th>Status</th><th>Total</th></tr></thead>
    <tbody>
    @foreach($orders as $order)
        <tr><td>{{ $order->id }}</td><td>{{ $order->customer_name }}</td><td>{{ $order->status }}</td><td>{{ $order->total_amount }}</td></tr>
    @endforeach
    </tbody>
</table>
{{ $orders->links() }}
@endsection

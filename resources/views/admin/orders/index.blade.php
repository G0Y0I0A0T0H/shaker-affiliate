@extends('layouts.app')

@section('content')
<h3>Orders Management</h3>
<table class="table table-striped bg-white">
    <thead><tr><th>#</th><th>Affiliate</th><th>Customer</th><th>Status</th><th>Total</th><th>Change</th></tr></thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td><td>{{ $order->affiliate->name }}</td><td>{{ $order->customer_name }}</td><td>{{ $order->status }}</td><td>{{ $order->total_amount }}</td>
            <td>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="d-flex gap-1">@csrf @method('PATCH')
                    <select class="form-select form-select-sm" name="status">
                        @foreach(['new','contacted','sold','not_sold','returned','exchange'] as $status)
                        <option value="{{ $status }}" @selected($order->status===$status)>{{ $status }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary">Save</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection

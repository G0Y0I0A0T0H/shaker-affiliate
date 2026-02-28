@extends('layouts.app')

@section('content')
<h3>Create Order</h3>
<form method="POST" action="{{ route('affiliate.orders.store') }}" class="card card-body">
    @csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Customer Name</label><input name="customer_name" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input name="customer_phone" class="form-control" required></div>
        <div class="col-12"><label class="form-label">Full Address</label><textarea name="customer_address" class="form-control" required></textarea></div>
        <div class="col-12"><label class="form-label">Notes</label><textarea name="customer_notes" class="form-control"></textarea></div>
    </div>
    <hr>
    <h5>Order Items (single line demo)</h5>
    <div class="row g-2">
        <div class="col-md-3"><input class="form-control" name="items[0][product_id]" placeholder="Product ID" required></div>
        <div class="col-md-3"><input class="form-control" name="items[0][variant_id]" placeholder="Variant ID" required></div>
        <div class="col-md-3"><input class="form-control" name="items[0][variant_size_id]" placeholder="Size ID" required></div>
        <div class="col-md-2"><input class="form-control" name="items[0][qty]" placeholder="Qty" required></div>
    </div>
    <button class="btn btn-success mt-3">Save Order</button>
</form>
@endsection

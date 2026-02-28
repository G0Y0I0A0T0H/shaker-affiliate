@extends('layouts.app')

@section('content')
<h3>Products / Variants / Stock</h3>
<div class="card card-body mb-3">
    <form method="POST" action="{{ route('admin.products.store') }}" class="row g-2">@csrf
        <div class="col"><input class="form-control" name="name" placeholder="Product Name" required></div>
        <div class="col"><input class="form-control" name="sku" placeholder="SKU" required></div>
        <div class="col"><input class="form-control" name="description" placeholder="Description"></div>
        <div class="col"><button class="btn btn-primary">Add Product</button></div>
    </form>
</div>
@foreach($products as $product)
<div class="card mb-3"><div class="card-body">
    <h5>{{ $product->name }} <small class="text-muted">{{ $product->sku }}</small></h5>
    <form method="POST" action="{{ route('admin.variants.store', $product) }}" class="row g-2 mb-2">@csrf
        <div class="col"><input class="form-control" name="color_name" placeholder="Color" required></div>
        <div class="col"><input class="form-control" name="color_code" placeholder="#000000" required></div>
        <div class="col"><input class="form-control" name="price" placeholder="Price" required></div>
        <div class="col"><button class="btn btn-outline-primary">Add Variant</button></div>
    </form>
    @foreach($product->variants as $variant)
        <div class="border rounded p-2 mb-2">
            <strong>{{ $variant->color_name }}</strong> - {{ $variant->price }}
            <form method="POST" action="{{ route('admin.sizes.store', $variant) }}" class="row g-2 mt-1">@csrf
                <div class="col"><input class="form-control" name="size_name" placeholder="Size" required></div>
                <div class="col"><input class="form-control" name="stock_qty" placeholder="Stock" required></div>
                <div class="col"><button class="btn btn-outline-secondary">Add Size</button></div>
            </form>
            <ul class="mt-2">@foreach($variant->sizes as $size)<li>{{ $size->size_name }} | stock {{ $size->stock_qty }} | reserved {{ $size->reserved_qty }}</li>@endforeach</ul>
        </div>
    @endforeach
</div></div>
@endforeach
@endsection

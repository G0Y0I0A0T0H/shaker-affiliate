@extends('layouts.app')

@section('content')
<h3>{{ $product->name }}</h3>
@php($variant = $product->variants->first())
@if($variant)
<div class="row">
    <div class="col-md-6">
        <div class="zoom-wrapper mb-2 text-center p-3 bg-white">
            @php($primary = $variant->images->first())
            <img id="mainImage" src="{{ $primary ? asset('storage/'.$primary->image_path) : 'https://placehold.co/600x600' }}" class="img-fluid" alt="main">
        </div>
        <div class="d-flex gap-2">
            @foreach($variant->images as $img)
                <img src="{{ asset('storage/'.$img->image_path) }}" class="gallery-thumb p-1" width="70" onclick="swapImage(this)">
            @endforeach
        </div>
    </div>
    <div class="col-md-6">
        <h5>Color: {{ $variant->color_name }}</h5>
        <h4 class="text-danger">{{ number_format($variant->price,2) }}</h4>
        <ul class="list-group">@foreach($variant->sizes as $size)<li class="list-group-item">{{ $size->size_name }} - Available: {{ $size->available_qty }}</li>@endforeach</ul>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
function swapImage(el){
 document.getElementById('mainImage').src = el.src;
 document.querySelectorAll('.gallery-thumb').forEach(t=>t.classList.remove('active'));
 el.classList.add('active');
}
</script>
@endpush

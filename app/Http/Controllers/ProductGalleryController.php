<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductGalleryController extends Controller
{
    public function show(Product $product): View
    {
        $product->load('variants.images', 'variants.sizes');
        return view('products.show', compact('product'));
    }
}

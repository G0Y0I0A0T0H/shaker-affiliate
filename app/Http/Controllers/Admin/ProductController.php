<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVariantImageRequest;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->with('variants.images', 'variants.sizes')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string'], 'sku' => ['required', 'string', 'unique:products,sku'],
            'description' => ['nullable', 'string']
        ]);
        Product::query()->create($data + ['is_active' => true]);
        return back()->with('success', 'Product created.');
    }

    public function storeVariant(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'color_name' => ['required', 'string'], 'color_code' => ['required', 'string', 'max:7'], 'price' => ['required', 'numeric', 'min:0']
        ]);
        $product->variants()->create($data + ['is_active' => true]);
        return back()->with('success', 'Variant created.');
    }

    public function storeSize(Request $request, ProductVariant $variant): RedirectResponse
    {
        $data = $request->validate([
            'size_name' => ['required', 'string'], 'stock_qty' => ['required', 'integer', 'min:0']
        ]);
        $variant->sizes()->create($data + ['reserved_qty' => 0]);
        return back()->with('success', 'Size created.');
    }

    public function storeImage(StoreVariantImageRequest $request): RedirectResponse
    {
        $path = $request->file('image')->store('variant-images', 'public');
        VariantImage::query()->create([
            'variant_id' => $request->integer('variant_id'),
            'image_path' => $path,
            'is_primary' => $request->boolean('is_primary'),
            'sort_order' => 0,
        ]);
        return back()->with('success', 'Image uploaded.');
    }
}

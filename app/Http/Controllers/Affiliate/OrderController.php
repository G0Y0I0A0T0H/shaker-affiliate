<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Affiliate\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\VariantSize;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->where('affiliate_id', auth()->id())->latest()->paginate(20);
        return view('affiliate.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $products = Product::query()->with('variants.sizes')->where('is_active', true)->get();
        return view('affiliate.orders.create', compact('products'));
    }

    public function store(StoreOrderRequest $request, StockService $stockService): RedirectResponse
    {
        $data = $request->validated();
        $stockService->reserveFromItems($data['items']);

        DB::transaction(function () use ($data): void {
            $affiliate = auth()->user();
            $order = Order::query()->create([
                'affiliate_id' => $affiliate->id,
                'status' => 'new',
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'customer_address' => $data['customer_address'],
                'customer_notes' => $data['customer_notes'] ?? null,
                'total_amount' => 0,
                'commission_amount' => 0,
                'status_changed_at' => now(),
            ]);

            $total = 0;
            foreach ($data['items'] as $item) {
                $size = VariantSize::query()->with('variant')->findOrFail($item['variant_size_id']);
                $lineTotal = $size->variant->price * $item['qty'];
                $total += $lineTotal;

                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'variant_id' => $item['variant_id'],
                    'variant_size_id' => $item['variant_size_id'],
                    'qty' => $item['qty'],
                    'unit_price' => $size->variant->price,
                    'line_total' => $lineTotal,
                    'notes' => $item['notes'] ?? null,
                ]);
            }

            $order->update([
                'total_amount' => $total,
                'commission_amount' => ($total * ($affiliate->commission_rate ?? 0)) / 100,
            ]);
        });

        return redirect()->route('affiliate.orders.index')->with('success', 'Order created, stock reserved.');
    }
}

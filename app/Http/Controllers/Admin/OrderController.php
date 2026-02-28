<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\StockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->with('affiliate', 'items.product', 'items.size')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order, StockService $stockService): RedirectResponse
    {
        $request->validate(['status' => ['required', 'in:new,contacted,sold,not_sold,returned,exchange']]);
        $from = $order->status;
        $to = $request->string('status')->toString();

        $stockService->applyStatusTransition($order, $from, $to);

        $order->update(['status' => $to, 'status_changed_at' => now()]);

        return back()->with('success', 'Order status updated.');
    }
}

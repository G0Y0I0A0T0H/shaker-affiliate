<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $affiliate = auth()->user();
        $orders = Order::query()->where('affiliate_id', $affiliate->id);

        $stats = [
            'total_orders' => (clone $orders)->count(),
            'sold_orders' => (clone $orders)->where('status', 'sold')->count(),
            'total_commissions' => (clone $orders)->where('status', 'sold')->sum('commission_amount'),
        ];

        return view('affiliate.dashboard.index', compact('stats', 'affiliate'));
    }
}

<?php

namespace App\Services;

use App\Models\Order;
use App\Models\VariantSize;
use Illuminate\Support\Facades\DB;

class StockService
{
    public function reserveFromItems(array $items): void
    {
        DB::transaction(function () use ($items): void {
            foreach ($items as $item) {
                $size = VariantSize::query()->lockForUpdate()->findOrFail($item['variant_size_id']);
                if (($size->stock_qty - $size->reserved_qty) < $item['qty']) {
                    abort(422, "Insufficient stock for {$size->size_name}");
                }
                $size->increment('reserved_qty', $item['qty']);
            }
        });
    }

    public function applyStatusTransition(Order $order, string $from, string $to): void
    {
        if ($from === $to) {
            return;
        }

        DB::transaction(function () use ($order, $from, $to): void {
            foreach ($order->items()->with('size')->get() as $item) {
                $size = VariantSize::query()->lockForUpdate()->findOrFail($item->variant_size_id);

                if ($to === 'sold' && $from !== 'sold') {
                    $size->reserved_qty = max(0, $size->reserved_qty - $item->qty);
                    $size->stock_qty = max(0, $size->stock_qty - $item->qty);
                }

                if (in_array($to, ['not_sold', 'returned'], true) && ! in_array($from, ['not_sold', 'returned'], true)) {
                    $size->reserved_qty = max(0, $size->reserved_qty - $item->qty);
                }

                if ($to === 'exchange') {
                    $size->reserved_qty = max(0, $size->reserved_qty - $item->qty);
                }

                $size->save();
            }
        });
    }
}

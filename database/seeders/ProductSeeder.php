<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $product = Product::query()->create([
            'name' => 'Shaker Hoodie',
            'sku' => 'SHK-HOODIE-001',
            'description' => 'Premium cotton hoodie for daily wear',
            'is_active' => true,
        ]);

        $variant = $product->variants()->create([
            'color_name' => 'Black',
            'color_code' => '#000000',
            'price' => 850,
            'is_active' => true,
        ]);

        $variant->sizes()->createMany([
            ['size_name' => 'M', 'stock_qty' => 30, 'reserved_qty' => 0],
            ['size_name' => 'L', 'stock_qty' => 20, 'reserved_qty' => 0],
        ]);
    }
}

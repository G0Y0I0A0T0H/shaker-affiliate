<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('affiliate_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['new', 'contacted', 'sold', 'not_sold', 'returned', 'exchange'])->default('new');
            $table->string('customer_name');
            $table->string('customer_phone', 20);
            $table->text('customer_address');
            $table->text('customer_notes')->nullable();
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->decimal('commission_amount', 12, 2)->default(0);
            $table->timestamp('status_changed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('variant_id')->constrained('product_variants')->cascadeOnDelete();
            $table->foreignId('variant_size_id')->constrained('variant_sizes')->cascadeOnDelete();
            $table->unsignedInteger('qty');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('line_total', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};

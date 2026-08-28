<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_request_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0.00);
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_request_details');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_requests', function (Blueprint $table) {
            $table->id();
            $table->string('reference_code')->unique(); // e.g. REQ-20260805-A19F
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('company_name')->nullable();
            $table->text('delivery_address')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_estimated_value', 12, 2)->default(0.00);
            $table->enum('status', ['new', 'under_review', 'quoted', 'approved', 'completed', 'cancelled'])->default('new');
            $table->text('admin_notes')->nullable();
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_requests');
    }
};

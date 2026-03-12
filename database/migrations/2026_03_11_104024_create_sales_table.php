<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->references('id')->on('shops');
            $table->integer('customer_id')->nullable();
            $table->integer('sale_type')->nullable();
            $table->foreign('sold_by')->references('id')->on('users');
            $table->integer('total_items')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('payment_status')->default(0); // 0 for pending, 1 for paid, 2 for partial
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->boolean('is_return')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

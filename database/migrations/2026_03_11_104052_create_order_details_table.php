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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->integer('ordered_quantity')->default(0);
            $table->integer('dispatched_quantity')->default(0);
            $table->integer('received_quantity')->default(0);
            $table->decimal('unit_cost', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2)->default(0);
            $table->foreign('delivery_note_id')->references('id')->on('delivery_notes')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};

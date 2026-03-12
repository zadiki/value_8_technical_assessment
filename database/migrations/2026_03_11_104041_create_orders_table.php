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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->references('id')->on('shops')->nullable();
            $table->foreignId('branch_id')->references('id')->on('branches')->nullable();
            $table->integer('order_type')->default(0); // 0 for branch order, 1 for shop order
            $table->foreign('ordered_by')->references('id')->on('users');
            $table->string('lpo_number')->nullable();
            $table->integer('total_items')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->integer('status')->default(0); // 0 for pending, 1 for received, 2 for cancelled ,3 for partial
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

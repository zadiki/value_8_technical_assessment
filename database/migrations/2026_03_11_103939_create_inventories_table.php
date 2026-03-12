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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->references('id')->on('branches')->nullable();
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreign('shop_id')->references('id')->on('shops')->nullable();
            $table->integer('quantity')->default(0);
            $table->decimal('cost_price', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);
            $table->integer("location_type")->default(0); // 0 for branch, 1 for shop floor
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->nullable();
            $table->integer('reorder_level')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};

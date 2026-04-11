<?php

declare(strict_types=1);

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
        Schema::create('delivery_notes', function (Blueprint $table) {
            $table->id();
            $table->integer('destination_type')->default(0); // 0 for branch, 1 for store
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('store_id')->references('id')->on('stores')->nullable();
            $table->unsignedBigInteger('branch_id')->references('id')->on('branches')->nullable();
            $table->unsignedBigInteger('approved_by')->references('id')->on('users')->nullable();
            $table->integer('approval_status')->default(0);    // 0 for pending, 1 for approved, 2 for rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_notes');
    }
};

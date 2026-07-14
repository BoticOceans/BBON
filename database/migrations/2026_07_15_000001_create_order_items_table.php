<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('order_type_id')->nullable()->constrained('order_types')->nullOnDelete();
            $table->foreignId('collar_id')->nullable()->constrained('collars')->nullOnDelete();
            $table->foreignId('fabric_id')->nullable()->constrained('fabrics')->nullOnDelete();
            $table->foreignId('colour_id')->nullable()->constrained('colours')->nullOnDelete();
            $table->foreignId('patch_id')->nullable()->constrained('patches')->nullOnDelete();
            $table->string('label')->nullable();
            $table->string('front')->nullable();
            $table->string('back')->nullable();
            $table->string('sleeves')->nullable();
            $table->json('sizes')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

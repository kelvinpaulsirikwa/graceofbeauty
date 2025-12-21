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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->foreignId('brand_id')->nullable()->constrained('brands', 'brand_id')->onDelete('restrict');
            $table->foreignId('category_id')->constrained('categories', 'category_id')->onDelete('restrict');
            $table->foreignId('subcategory_id')->nullable()->constrained('subcategories', 'subcategory_id')->onDelete('restrict');
            $table->string('front_image')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

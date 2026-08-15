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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vendor_location_id')->constrained()->restrictOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->foreignId('logistics_profile_id')->nullable()->constrained('logistics_profiles')->nullOnDelete();
            $table->foreignId('weight_class_id')->nullable()->constrained('weight_classes')->restrictOnDelete();
            $table->foreignId('size_class_id')->nullable()->constrained('size_classes')->restrictOnDelete();
            $table->string('name', 191);
            $table->string('slug', 220);
            $table->text('description')->nullable();
            $table->string('sku', 80)->nullable();
            $table->decimal('price', 12, 2);
            $table->char('currency', 3)->default('NGN');
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->enum('status', ['draft', 'active', 'inactive', 'out_of_stock', 'archived'])->default('draft');
            $table->timestamps();

            $table->softDeletes();

            $table->unique(['vendor_id', 'sku']);
            $table->index(['category_id', 'status']);
            $table->index(['brand_id']);
            $table->index(['vendor_id', 'status']);
            $table->index(['status', 'price']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

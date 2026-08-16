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
        Schema::create('vendor_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constraind('vendors')->cascadeOnDelete();
            $table->string('label');
            $table->string('address_line')->nullable();
            $table->string('city')->index();
            $table->string('state')->index();
            $table->char('country_code', 2)->default('NG');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
            $table->index(['vendor_id', 'is_primary']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_locations');
    }
};

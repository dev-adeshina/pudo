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
        Schema::create('v_ride_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vride_id')
                ->constrained('vrides')
                ->cascadeOnDelete();

            $table->foreignId('service_type_id')
                ->constrained('service_types')
                ->restrictOnDelete();

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->unique(['vride_id', 'service_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_ride_services');
    }
};

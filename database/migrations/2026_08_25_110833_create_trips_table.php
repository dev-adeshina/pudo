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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('v_ride_id')->constrained('v_rides')->cascadeOnDelete();
            $table->string('type');
            $table->datetime('available_at');
            $table->string('departure');
            $table->string('destination');
            $table->decimal('start_latitude', 10, 7);
            $table->decimal('start_longitude', 10, 7);
            $table->unsignedInteger('seats_available');
            $table->string('status')->default('available');
            $table->timestamps();
            $table->index(['type', 'status', 'available_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};




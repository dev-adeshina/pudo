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
        Schema::create('v_ride_capabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('v_ride_id')->constrained('v_rides')->cascadeOnDelete();
            $table->foreignId('capability_id')->constrained('capabilities')->restrictOnDelete();
            $table->string('status')->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->unique(['vride_id', 'capability_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_ride_capabilities');
    }
};

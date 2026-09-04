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
        Schema::create('v_rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('v_ride_type_id')->constrained('v_ride_types');
            $table->foreignId('pudo_id')->constrained('pudos')->cascadeOnDelete();
            $table->string('status')->default('pending');

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('suspended_at')->nullable();

            $table->text('suspension_reason')->nullable();
            $table->timestamps();
            $table->index(['v_ride_type_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_rides');
    }
};

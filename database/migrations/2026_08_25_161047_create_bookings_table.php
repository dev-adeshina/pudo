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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
            $table->foreignId('passenger_id')->as('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('seats');
            $table->string('booking_reference')->unique();
            $table->string('pickup_location');
            $table->decimal('pickup_latitude', 10, 7);
            $table->decimal('pickup_longitude', 10, 7);
            $table->string('dropoff_location');
            $table->decimal('dropoff_latitude', 10, 7);
            $table->decimal('dropoff_longitude', 10, 7);
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamp('expires_at');
            $table->timestamp('confirmed_at');
            $table->timestamp('cancelled_at');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};





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
        Schema::create('v_ride_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('v_ride_id')->unique()->constrained('v_rides')->cascadeOnDelete();
            $table->text('bio')->nullable();
            $table->unsignedSmallInteger('years_of_experience')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_ride_profiles');
    }
};

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
        Schema::create('v_ride_kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('v_ride_id')->constrained('v_rides')->cascadeOnDelete();
            $table->enum('id_type', ['NIN', 'BVN', 'PASSPORT', 'DL']);
            $table->string('code')->nullable();
            $table->string('front_image_path')->nullable();
            $table->string('back_image_path')->nullable();
            $table->enum('status', ['pending', 'processing', 'rejected', 'verified']);
            $table->string('lookup_provider')->nullable();
            $table->enum('selfie', ['pending', 'approved', 'rejected'])->default('pending');

            $table->string('make');
            $table->string('model')->nullable();
            $table->unsignedSmallInteger('year')->nullable();

            $table->string('color')->nullable();

            $table->string('registration_number')->unique();
            $table->string('plate_number')->unique();

            $table->string('vin')->nullable()->unique();

            $table->decimal('weight_capacity', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_ride_kycs');
    }
};

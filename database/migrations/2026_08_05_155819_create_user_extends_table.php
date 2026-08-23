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
        Schema::create('user_extends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('profile_type_id');
            $table->string('code')->unique()->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->dateTime('dob');
            $table->string('profile_photo_path');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->enum('status', ['pending', 'active', 'rejected', 'suspended'])->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_extends');
    }
};

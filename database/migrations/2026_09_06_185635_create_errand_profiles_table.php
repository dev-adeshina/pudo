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
        Schema::create('errand_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('errand_id')->constrained('errands')->cascadeOnDelete();
            $table->text('residential_address');
            $table->text('description');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_mobile');
            $table->boolean('availability')->default(true);
            $table->enum('contact_verification', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errand_profiles');
    }
};

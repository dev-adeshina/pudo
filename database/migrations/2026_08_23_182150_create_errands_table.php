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
        Schema::create('errands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('profile_type_id')->constrained('profile_types')->cascadeOnDelete();
            $table->foreignId('errand_type_id')->constrained('errand_type')->casecadeOnDelete();
            $table->datetime('dob');
            $table->text('residential_address');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_mobile');
            $table->enum('contact_verification', [true, false])->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errands');
    }
};

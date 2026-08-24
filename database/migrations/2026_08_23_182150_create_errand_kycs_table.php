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
        Schema::create('errand_kycs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('errand_id')->constrained('errands')->cascadeOnDelete();
            $table->text('current_location');
            $table->text('service_area');
            $table->enum('availability', [true, false])->default(false);
            $table->enum('id_type', ['NIN', 'BVN', 'PASSPORT', 'DL']);
            $table->string('code')->nullable();
            $table->string('front_image_path')->nullable();
            $table->string('back_image_path')->nullable();
            $table->enum('status', ['pending', 'processing', 'rejected', 'verified']);
            $table->string('lookup_provider')->nullable();
            $table->enum('selfie', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('provider_trnx');
            $table->json('provider_meta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errand_kycs');
    }
};

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
        Schema::create('certificate_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('errand_certificate_id')->constrained('errand_certificates')->cascadeOnDelete();
            $table->string('method');
            $table->string('provider');
            $table->string('provider_reference');
            $table->timestamp('verified_by');
            $table->timestamp('verified_at');
            $table->text('notes');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_verifications');
    }
};

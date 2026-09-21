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
        Schema::create('kyc_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kyc_id')->constrained('kycs')->cascadeOnDelete();
            $table->string('type');
            $table->string('country', 2)->default('NG');
            $table->string('document_number')->nullable();
            $table->string('provider')->default('dojah');
            $table->string('provider_reference')->nullable();
            $table->string('status')->default('pending');
            $table->string('file_path')->nullable();
            $table->string('file_url')->nullable();
            $table->json('metadata')->nullable();
            $table->json('provider_response')->nullable();
            $table->text('failure_reason')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kyc_documents');
    }
};

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
        Schema::create('compliance_profiles', function (Blueprint $table) {
            $table->id();
            $table->morphs('subject');

            $table->string('kyc_status')->default('pending');

            $table->string('risk_level')->default('unknown');

            $table->timestamp('verified_at')->nullable();

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            $table->index([
                'subject_type',
                'subject_id',
                'kyc_status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compliance_profiles');
    }
};

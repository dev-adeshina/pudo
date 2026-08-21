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
        Schema::create('reconciliation_runs', function (Blueprint $table) {
            $table->id();
            $table->string('provider');

            $table->foreignId('provider_account_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->unsignedBigInteger('internal_balance_minor');

            $table->unsignedBigInteger('provider_balance_minor');

            $table->bigInteger('difference_minor');

            $table->string('status');

            $table->timestamp('started_at');

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            $table->index([
                'provider',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reconciliation_runs');
    }
};

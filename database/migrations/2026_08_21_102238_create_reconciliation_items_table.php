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
        Schema::create('reconciliation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reconciliation_run_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained('transactions')
                ->nullOnDelete();

            $table->foreignId('provider_transaction_id')
                ->nullable()
                ->constrained('provider_transactions')
                ->nullOnDelete();

            $table->unsignedBigInteger('internal_amount_minor')
                ->nullable();

            $table->unsignedBigInteger('provider_amount_minor')
                ->nullable();

            $table->bigInteger('difference_minor')
                ->nullable();

            $table->string('status');

            $table->string('reason')->nullable();

            $table->timestamps();

            $table->index([
                'reconciliation_run_id',
                'status',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reconciliation_items');
    }
};

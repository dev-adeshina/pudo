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
        Schema::create('provider_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_account_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('transaction_id')
                ->constrained('transactions')
                ->restrictOnDelete();

            $table->string('provider');

            $table->string('provider_transaction_id');

            $table->string('provider_reference')->nullable();

            $table->unsignedBigInteger('amount_minor');

            $table->char('currency', 3);

            $table->string('status');

            $table->string('raw_status')->nullable();

            $table->timestamp('occurred_at')->nullable();

            $table->timestamps();

            $table->unique([
                'provider',
                'provider_transaction_id',
            ]);

            $table->index([
                'transaction_id',
                'provider',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_transactions');
    }
};

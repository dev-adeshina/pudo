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
        Schema::create('transaction_links', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('source_transaction_id')->constrained('transactions')->restrictOnDelete();
            // $table->foreignId('destination_transaction_id')->constrained('transactions')->restrictOnDelete();
            // $table->string('relationship_type');
            // $table->unsignedBigInteger('amount_minor');
            // $table->timestamps();

            // $table->index(['source_transaction_id', 'destination_transaction_id', 'transaction_links_tx_pair_idx']); 
            $table->foreignId('source_transaction_id')
                ->constrained('transactions')
                ->restrictOnDelete();

            $table->foreignId('destination_transaction_id')
                ->constrained('transactions')
                ->restrictOnDelete();

            $table->string('relationship_type');
            $table->unsignedBigInteger('amount_minor');

            $table->timestamps();

            $table->index(
                ['source_transaction_id', 'destination_transaction_id'],
                'transaction_links_tx_pair_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_links');
    }
};

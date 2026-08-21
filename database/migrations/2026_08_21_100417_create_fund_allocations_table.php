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
        Schema::create('fund_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->restrictOnDelete();
            $table->foreignId('transaction_id')->constrained('transactions')->restrictOnDelete();
            $table->foreignId('root_transaction_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->foreignId('parent_allocation_id')->nullable()->constrained('fund_allocations')->nullOnDelete();
            $table->string('source_type');
            $table->unsignedBigInteger('original_amount_minor');
            $table->unsignedBigInteger('remaining_amount_minor');
            $table->string('withdrawal_policy');
            $table->timestamps();
            $table->index(['wallet_id', 'source_type']);
            $table->index(['wallet_id', 'withdrawal_policy']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fund_allocations');
    }
};

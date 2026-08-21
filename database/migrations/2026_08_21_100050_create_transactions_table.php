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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('signature')->unique();
            $table->foreignId('wallet_id')->constrained()->restrictOnDelete();
            $table->foreignId('root_transaction_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->foreignId('parent_transaction_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->string('type');
            $table->unsignedBigInteger('amount_minor');
            $table->char('currency', 3);
            $table->string('status')->default('pending');
            $table->string('reference')->unique();
            $table->nullableMorphs('initiator');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->index(['wallet_id', 'root_transaction_id']);
            $table->index('parent_transaction_id');
            $table->index(['wallet_id', 'status']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

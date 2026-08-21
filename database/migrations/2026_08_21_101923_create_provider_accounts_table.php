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
        Schema::create('provider_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('provider');

            $table->string('provider_account_id');

            $table->string('account_number')->nullable();

            $table->string('account_name')->nullable();

            $table->string('bank_code')->nullable();

            $table->char('currency', 3)->default('NGN');

            $table->string('status')->default('active');

            $table->boolean('is_primary')->default(false);

            $table->timestamp('opened_at')->nullable();

            $table->timestamp('closed_at')->nullable();

            $table->timestamps();

            $table->unique([
                'provider',
                'provider_account_id',
            ]);

            $table->index([
                'wallet_id',
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
        Schema::dropIfExists('provider_accounts');
    }
};

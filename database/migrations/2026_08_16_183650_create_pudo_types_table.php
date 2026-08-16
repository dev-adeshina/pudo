<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pudo_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('pudo_types')->insert([
            ['name' => 'Vendor', 'slug' => 'vendor', 'is_active' => true],
            ['name' => 'VeriDrive', 'slug' => 'veri-drive', 'is_active' => true],
            ['name' => 'Agent', 'slug' => 'agent', 'is_active' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pudo_types');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('user_merchants_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_user_id')->constrained('merchants');
            $table->foreignId('merchant_id')->constrained('merchants');
            $table->enum('role', ['owner', 'seller']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('user_merchants_pivot');
    }
};

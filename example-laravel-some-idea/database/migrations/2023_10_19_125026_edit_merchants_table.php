<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('merchants', function (Blueprint $table) {
            $table->dropColumn('coordinate');
            $table->double('latitude');
            $table->double('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('merchants', function (Blueprint $table) {
            $table->point('coordinate');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};

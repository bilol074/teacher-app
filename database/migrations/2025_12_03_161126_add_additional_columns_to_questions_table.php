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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->integer('duration_time')->nullable();
            $table->dateTime('until_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('duration_time');
            $table->dropColumn('until_time');
        });
    }
};

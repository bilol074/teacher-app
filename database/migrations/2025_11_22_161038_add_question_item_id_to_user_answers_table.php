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
        Schema::table('user_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('question_item_id')->nullable();
            $table->foreign('question_item_id')->references('id')->on('question_items');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropForeign('user_answers_question_item_id_foreign');
            $table->dropColumn('question_item_id');
        });
    }
};

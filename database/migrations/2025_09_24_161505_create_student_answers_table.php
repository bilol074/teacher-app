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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('question_id');

            $table->unique(['student_id', 'question_id']); 
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->string('answers');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};

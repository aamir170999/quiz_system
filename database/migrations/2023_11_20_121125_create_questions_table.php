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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->text('question');
            $table->char('correct_option');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('option_e')->nullable();
            $table->string('option_f')->nullable();
            $table->string('code_snippet')->nullable();
            $table->string('Answer_Explanation')->nullable();
            $table->string('image_file')->nullable();
            $table->string('video_file')->nullable();
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('exams')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};


// {{-- table columns
//     quiz_id
//     question
//     option_a
//     option_b
//     option_c
//     option_d
//     option_e
//     option_f
//     correct_option
//     code_snippet
//     Answer_Explanation
//     image_file
//     video_file


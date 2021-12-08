<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingExamAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_exam_answer', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('meeting_exam_collection_id');
        $table->foreign('meeting_exam_collection_id')->references('id')->on('meeting_exam_collection');
        $table->uuid('meeting_exam_question_id');
        $table->foreign('meeting_exam_question_id')->references('id')->on('meeting_exam_question');
        $table->text('answer')->nullable();
        $table->boolean('is_multiple_choice');
        $table->boolean('is_true')->nullable();
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_exam_answer ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_exam_answer');
    }
}

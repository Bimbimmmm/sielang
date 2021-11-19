<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingQuizQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('meeting_quiz_question', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('meeting_quiz_id');
          $table->foreign('meeting_quiz_id')->references('id')->on('meeting_quiz');
          $table->text('question');
          $table->string('question_file')->nullable();
          $table->boolean('is_multiple_choice');
          $table->boolean('is_deleted');
          $table->timestamps();
        });
        DB::statement('ALTER TABLE meeting_quiz_question ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_quiz_question');
    }
}

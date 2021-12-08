<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingExamCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_exam_collection', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('meeting_exam_id');
        $table->foreign('meeting_exam_id')->references('id')->on('meeting_exam');
        $table->uuid('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->double('multiple_choice_score')->nullable();
        $table->double('essay_score')->nullable();
        $table->double('total_score')->nullable();
        $table->boolean('is_finished');
        $table->boolean('is_scored');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_exam_collection ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_exam_collection');
    }
}

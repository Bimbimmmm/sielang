<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonResultDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('lesson_result_detail', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('lesson_result_id');
          $table->foreign('lesson_result_id')->references('id')->on('lesson_result');
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->double('attendance');
          $table->double('task');
          $table->double('quiz');
          $table->double('exam');
          $table->timestamps();
        });
        DB::statement('ALTER TABLE lesson_result_detail ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_result_detail');
    }
}

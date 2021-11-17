<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachingHourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('teaching_hour', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->uuid('subject_id');
        $table->foreign('subject_id')->references('id')->on('subject');
        $table->uuid('class_id');
        $table->foreign('class_id')->references('id')->on('class');
        $table->integer('school_id');
        $table->foreign('school_id')->references('id')->on('reference_schools');
        $table->integer('hour');
        $table->string('semester_period');
        $table->string('year');
        $table->boolean('is_active');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE teaching_hour ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teaching_hour');
    }
}

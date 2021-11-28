<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEnrolledTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('student_enrolled', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('teaching_hour_id');
          $table->foreign('teaching_hour_id')->references('id')->on('teaching_hour');
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->boolean('is_active');
          $table->boolean('is_deleted');
          $table->timestamps();
        });
        DB::statement('ALTER TABLE student_enrolled ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_enrolled');
    }
}

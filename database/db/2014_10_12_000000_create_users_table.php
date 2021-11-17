<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('users', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->string('email')->unique();
          $table->string('password');
          $table->uuid('teacher_personal_data_id')->nullable();
          $table->foreign('teacher_personal_data_id')->references('id')->on('teacher_personal_data');
          $table->uuid('student_personal_data_id')->nullable();
          $table->foreign('student_personal_data_id')->references('id')->on('student_personal_data');
          $table->integer('school_id');
          $table->foreign('school_id')->references('id')->on('reference_schools');
          $table->uuid('role_id');
          $table->foreign('role_id')->references('id')->on('roles');
          $table->boolean('is_deleted');
          $table->rememberToken();
          $table->timestamps();
      });
      DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

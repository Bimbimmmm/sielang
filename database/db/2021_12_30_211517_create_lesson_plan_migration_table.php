<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonPlanMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('lesson_plan', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->uuid('teaching_hour_id');
          $table->foreign('teaching_hour_id')->references('id')->on('teaching_hour');
          $table->string('type');
          $table->boolean('is_active');
          $table->boolean('is_deleted');
          $table->timestamps();
        });
        DB::statement('ALTER TABLE lesson_plan ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_plan_migration');
    }
}

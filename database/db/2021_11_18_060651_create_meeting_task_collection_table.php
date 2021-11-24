<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingTaskCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_task_collection', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('meeting_task_id');
        $table->foreign('meeting_task_id')->references('id')->on('meeting_task');
        $table->uuid('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->string('file');
        $table->double('score');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_task_collection ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_task_collection');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_room', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->uuid('teaching_hour_id');
        $table->foreign('teaching_hour_id')->references('id')->on('teaching_hour');
        $table->timestamp('start_date');
        $table->timestamp('expired_date');
        $table->string('meeting_media');
        $table->string('link')->nullable();
        $table->string('subject_material_link')->nullable();
        $table->string('file');
        $table->boolean('is_active');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_room ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_room');
    }
}

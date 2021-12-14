<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRoomAttendanceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_room_attendance_detail', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('meeting_room_attendance_id');
        $table->foreign('meeting_room_attendance_id')->references('id')->on('meeting_room_attendance');
        $table->uuid('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->boolean('is_attend')->nullable();
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_room_attendance_detail ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_room_attendance_detail');
    }
}

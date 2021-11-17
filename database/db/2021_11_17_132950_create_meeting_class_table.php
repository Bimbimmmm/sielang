<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('meeting_class', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->uuid('meeting_room_id');
        $table->foreign('meeting_room_id')->references('id')->on('meeting_room');
        $table->string('room_type');
        $table->string('link');
        $table->timestamp('start_date');
        $table->timestamp('expired_date');
        $table->boolean('is_active');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE meeting_class ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_class');
    }
}

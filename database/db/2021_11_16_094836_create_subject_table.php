<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('subject', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->string('name');
        $table->boolean('is_compulsory');
        $table->integer('school_id');
        $table->foreign('school_id')->references('id')->on('reference_schools');
        $table->boolean('is_deleted');
        $table->timestamps();
      });
      DB::statement('ALTER TABLE subject ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExecutivePersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('executive_personal_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('registration_number');
            $table->string('id_number');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('position');
            $table->integer('rank_id');
            $table->foreign('rank_id')->references('id')->on('reference_ranks');
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('zip_code');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE executive_personal_data ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('executive_personal_data');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentPersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('parent_personal_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('id_number');
            $table->uuid('student_personal_data_id')->nullable();
            $table->foreign('student_personal_data_id')->references('id')->on('student_personal_data');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->integer('religion_id');
            $table->foreign('religion_id')->references('id')->on('reference_religions');
            $table->string('phone_number');
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('zip_code');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE parent_personal_data ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parent_personal_data');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPersonalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('student_personal_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('registration_number');
            $table->string('id_number');
            $table->string('student_number');
            $table->string('national_student_number');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->integer('religion_id');
            $table->foreign('religion_id')->references('id')->on('reference_religions');
            $table->integer('school_id');
            $table->foreign('school_id')->references('id')->on('reference_schools');
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('zip_code');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE student_personal_data ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_personal_data');
    }
}

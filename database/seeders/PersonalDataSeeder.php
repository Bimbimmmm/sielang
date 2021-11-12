<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class PersonalDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('personal_datas')->insert([
          [
              'name' => 'Administrator',
              'registration_number' => '1234567890',
              'id_number' => '0987654321',
              'student_number' => '7658493021',
              'birth_place' => 'Tidung Pale',
              'birth_date' => Carbon::now()->format('Y-m-d'),
              'gender' => 'Laki-laki',
              'marital_status_id' => 1,
              'religion_id' => 1,
              'rank_id' => 9,
              'work_unit_id' => 1,
              'position_id' => 1,
              'status_id' => 4,
              'education_id' => 3,
              'cs_year' => Carbon::now()->format('Y-m-d'),
              'cs_candidate_year' => Carbon::now()->format('Y-m-d'),
              'tax_number' => Carbon::now()->format('Y-m-d'),
              'address' => 'Jl. Perintis RT. 07',
              'province' => 'KALIMANTAN UTARA',
              'city' => 'KABUPATEN TANA TIDUNG',
              'district' => 'SESAYAP',
              'village' => 'TIDENG PALE',
              'zip_code' => '77152',
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}

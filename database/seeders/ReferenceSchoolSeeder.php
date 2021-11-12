<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReferenceSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_schools')->insert([
          [
              'name' => 'SMAN 1 Krayan',
              'national_school_number' => '30400533',
              'is_public' => TRUE,
              'address' => 'Jl. Kampung Baru',
              'province' => 'KALIMANTAN UTARA',
              'city' => 'KABUPATEN NUNUKAN',
              'district' => 'KRAYAN',
              'village' => 'LONG BAWAN',
              'zip_code' => '77456',
              'is_deleted' => FALSE
          ]
      ]);
    }
}

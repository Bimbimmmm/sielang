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
              'name' => 'Cabang Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Utara Wilayah Nunukan',
              'national_school_number' => 'xxxx',
              'is_public' => TRUE,
              'address' => 'Jl. Iskandar Muda',
              'province' => 'KALIMANTAN UTARA',
              'city' => 'KABUPATEN NUNUKAN',
              'district' => 'NUNUKAN',
              'village' => 'NUNUKAN BARAT',
              'zip_code' => '77456',
              'is_deleted' => FALSE
          ]
      ]);
    }
}

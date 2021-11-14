<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReferencePositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_positions')->insert([
          [
              'name' => 'Staff',
              'is_functional' => FALSE,
              'echelon' => 'Non-Eselon',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepala Sub-Bagian / Kepala Seksi',
              'is_functional' => FALSE,
              'echelon' => 'Eselon 4',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepala Cabang',
              'is_functional' => FALSE,
              'echelon' => 'Eselon 3',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepala Bidang',
              'is_functional' => FALSE,
              'echelon' => 'Eselon 3',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepala Dinas',
              'is_functional' => FALSE,
              'echelon' => 'Eselon 2',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Guru Pertama',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Guru Muda',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Guru Madya',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Guru Utama',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Kepala Sekolah',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Pengawas',
              'is_functional' => TRUE,
              'echelon' => 'Jabatan Fungsional',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Eksekutif',
              'is_functional' => FALSE,
              'echelon' => 'Jabatan Tinggi',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}

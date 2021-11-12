<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReferenceEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('reference_educations')->insert([
          [
              'name' => 'Doktoral (S3)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Magister (S2)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Sarjana (S1)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Sekolah Menengah Atas (SMA)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Sekolah Menengh Pertama (SMP)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Sekolah Dasar (SD)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Taman Kanak-Kanak (TK)',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ],
          [
              'name' => 'Tidak Bersekolah',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('roles')->insert([
          [
              'name' => 'Administrator',
              'number' => 1
          ],
          [
              'name' => 'Guru',
              'number' => 2
          ],
          [
              'name' => 'Kepala Sekolah',
              'number' => 3
          ],
          [
              'name' => 'Pelajar',
              'number' => 4
          ],
          [
              'name' => 'Operator Sekolah',
              'number' => 5
          ],
          [
              'name' => 'Eksekutif',
              'number' => 6
          ]
      ]);
    }
}

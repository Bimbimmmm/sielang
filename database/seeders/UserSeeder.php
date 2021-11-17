<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
          [
              'email' => 'admin@sielang.com',
              'password' => Hash::make('namamuji'),
              'role_id' => '387f3fd5-f2b8-436e-b36b-5c47a0ad8e0a',
              'school_id' => 4,
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}

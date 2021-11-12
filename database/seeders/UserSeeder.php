<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
              'email' => 'admin@guru.tanatidungkab.go.id',
              'password' => Hash::make('@dm1n3guru'),
              'personal_data_id' => '838d5824-6760-4597-8a46-0fd84bb6e771',
              'role_id' => '818ba4b5-83d1-4a93-b125-dd22e85678cb',
              'is_deleted' => FALSE,
              'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
          ]
      ]);
    }
}

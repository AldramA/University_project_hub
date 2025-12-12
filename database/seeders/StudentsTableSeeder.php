<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('students')->insert([
      [
        'full_name' => 'Mohamed Sobhy',
        'email' => 'mohamed@example.com',
        'password' => Hash::make('12345678'),
        'phone' => '01099142077',
        'year' => '3',
        'department' => 'Computer Science',
      ],
      [
        'full_name' => 'Ahmed Ali',
        'email' => 'ahmed@example.com',
        'password' => Hash::make('12345678'),
        'phone' => '01112345678',
        'year' => '2',
        'department' => 'Computer Science',
      ],
    ]);
  }
}

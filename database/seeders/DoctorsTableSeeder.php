<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorsTableSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('doctors')->insert([
      [
        'doctor_id' => 1,
        'full_name' => 'Dr. Khaled',
        'email' => 'khaled@example.com',
        'password' => Hash::make('12345678'),
        'department' => 'Computer Science',
      ]
    ]);
  }
}

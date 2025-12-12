<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('courses')->insert([
      [
        'course_name' => 'Database Systems',
        'course_code' => 'CS301',
        'doctor_id' => 1,
      ],
      [
        'course_name' => 'Data Structures',
        'course_code' => 'CS302',
        'doctor_id' => 1,
      ],
      [
        'course_name' => 'Computer Networks',
        'course_code' => 'CS303',
        'doctor_id' => 1,
      ],
      [
        'course_name' => 'Computer Architecture',
        'course_code' => 'CS304',
        'doctor_id' => 1,
      ],
    ]);
  }
}

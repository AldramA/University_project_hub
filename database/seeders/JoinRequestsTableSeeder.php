<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JoinRequestsTableSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('join_requests')->insert([
      [
        'project_id' => 2,
        'student_id' => 2,
        'status' => 'pending',
      ],
      [
        'project_id' => 1,
        'student_id' => 2,
        'status' => 'approved',
      ],
    ]);
  }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('comments')->insert([
      [
        'project_id' => 1,
        'doctor_id' => 1,
        'comment_text' => 'Good progress, keep it up!',
      ],
      [
        'project_id' => 2,
        'doctor_id' => 1,
        'comment_text' => 'Please update the documentation.',
      ],
    ]);
  }
}

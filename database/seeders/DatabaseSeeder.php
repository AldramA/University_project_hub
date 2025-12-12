<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;


  public function run(): void
  {
    $this->call([
      StudentsTableSeeder::class,
      DoctorsTableSeeder::class,
      CoursesTableSeeder::class,
      ProjectsTableSeeder::class,
      ProjectMembersTableSeeder::class,
      JoinRequestsTableSeeder::class,
      CommentsTableSeeder::class,
    ]);
  }
}

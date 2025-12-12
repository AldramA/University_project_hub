<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
  public function run(): void
  {
    DB::table('projects')->insert([
      [
        'project_name' => 'Student Management System',
        'description' => 'A project to manage students and courses',
        'project_link' => 'http://example.com/sms',
        'github_link' => 'http://github.com/example/sms',
        'course_id' => 1,
        'doctor_id' => 1,
        'admin_id' => 1,
        'status' => 'pending',
        'grade' => null,
        'feedback' => null,
      ],
      [
        'project_name' => 'Library System',
        'description' => 'Manage books and members',
        'project_link' => null,
        'github_link' => null,
        'course_id' => 1,
        'doctor_id' => 1,
        'admin_id' => 2,
        'status' => 'pending',
        'grade' => null,
        'feedback' => null,
      ],
    ]);
  }
}

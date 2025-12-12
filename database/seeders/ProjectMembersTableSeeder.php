<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectMembersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('project_members')->insert([
            [
                'project_id' => 1,
                'student_id' => 2,
                'role' => 'member',
                'join_status' => 'approved',
            ],
            [
                'project_id' => 2,
                'student_id' => 1,
                'role' => 'member',
                'join_status' => 'pending',
            ],
        ]);
    }
}

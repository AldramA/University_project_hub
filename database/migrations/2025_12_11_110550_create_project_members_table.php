<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_members', function (Blueprint $table) {
            $table->id('member_id');

            $table->foreignId('project_id')
                  ->constrained('projects', 'project_id')
                  ->cascadeOnDelete();

            $table->foreignId('student_id')
                  ->constrained('students', 'student_id')
                  ->cascadeOnDelete();

            $table->string('role')->nullable();
            $table->string('join_status')->default('pending');
            $table->timestamp('joined_at')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_members');
    }
};

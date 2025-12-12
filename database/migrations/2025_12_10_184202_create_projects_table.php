<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('projects', function (Blueprint $table) {
      $table->id('project_id');
      $table->string('project_name');
      $table->text('description')->nullable();
      $table->string('project_link')->nullable();
      $table->string('github_link')->nullable();

      // FK to courses
      $table->unsignedBigInteger('course_id');
      $table->foreign('course_id')
        ->references('course_id')->on('courses')
        ->onDelete('cascade');

      // FK to doctors
      $table->unsignedBigInteger('doctor_id');
      $table->foreign('doctor_id')
        ->references('doctor_id')->on('doctors')
        ->onDelete('cascade');

      // FK to students (as admin)
      $table->unsignedBigInteger('admin_id');
      $table->foreign('admin_id')
        ->references('student_id')->on('students')
        ->onDelete('cascade');

      // Other fields
      $table->string('status')->default('pending');
      $table->float('grade')->nullable();
      $table->text('feedback')->nullable();

      $table->timestamps();
    });
  }


  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('projects');
  }
};

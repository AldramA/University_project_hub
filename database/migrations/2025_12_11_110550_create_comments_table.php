<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');

            $table->foreignId('project_id')
                  ->constrained('projects', 'project_id')
                  ->cascadeOnDelete();

            $table->foreignId('doctor_id')
                  ->constrained('doctors', 'doctor_id')
                  ->cascadeOnDelete();

            $table->text('comment_text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');                   // PK
            $table->string('full_name');               // full name
            $table->string('email')->unique();         // unique email
            $table->string('password');                // password
            $table->string('phone');                   // phone
            $table->string('year');                    // academic year
            $table->string('department');              // department
            $table->timestamp('created_at')->useCurrent(); // created_at only
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

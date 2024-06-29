<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', length: 20)->unique();
            $table->string('password');
            $table->string('first_name_th', length: 100);
            $table->string('last_name_th', length: 100);
            $table->enum('prefix', ['MR', 'MISS', 'MRS']);
            $table->string('first_name_en', length: 100);
            $table->string('last_name_en', length: 100);
            $table->string('rmutto_email', length: 150)->unique();
            $table->string('tel', length: 15)->nullable();
            $table->enum('role', ['STUDENT', 'TEACHER', 'ADMIN'])->default('STUDENT');
            $table->enum('status', ['ENABLE', 'DISABLE'])->default('ENABLE');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Status;

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
            $table->enum('prefix', [Prefix::MR, Prefix::MISS, Prefix::MRS]);
            $table->string('first_name_en', length: 100);
            $table->string('last_name_en', length: 100);
            $table->string('rmutto_email', length: 150)->unique();
            $table->string('tel', length: 15)->nullable();
            $table->enum('role', [Role::STUDENT, Role::TEACHER, Role::ADMIN])->default(Role::STUDENT);
            $table->enum('status', [Status::ENABLE, Status::DISABLE])->default(Status::ENABLE);
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

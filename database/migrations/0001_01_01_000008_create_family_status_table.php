<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_status', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 50)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_status');
    }
};

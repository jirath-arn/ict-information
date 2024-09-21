<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relationships', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 15)->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relationships');
    }
};

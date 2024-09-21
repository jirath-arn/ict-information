<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Transfer;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('advisor_id')->unsigned();
            $table->foreign('advisor_id')->references('id')->on('users');
            $table->string('student_status_code', length: 2);
            $table->foreign('student_status_code')->references('code')->on('student_status');
            $table->smallInteger('level');
            $table->year('year');
            $table->enum('transfer', [Transfer::NORMAL, Transfer::TRANSFER]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_information');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Education;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('education_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->enum('education', [Education::SECONDARY_3, Education::SECONDARY_6, Education::VOC_CERT, Education::HIGH_VOC_CERT, Education::BACHELORS_DEGREE, Education::MASTERS_DEGREE, Education::PHD]);
            $table->string('name_school');
            $table->string('qualification');
            $table->year('graduate_year');
            $table->decimal('gpa', total: 3, places: 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_information');
    }
};

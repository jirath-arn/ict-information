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
            $table->enum('education', [Education::SECONDARY_3, Education::SECONDARY_6, Education::VOC_CERT, Education::HIGH_VOC_CERT, Education::BACHELORS_DEGREE, Education::MASTERS_DEGREE, Education::PHD])->nullable();
            $table->string('name_school')->nullable();
            $table->string('qualification')->nullable();
            $table->year('graduate_year')->nullable();
            $table->decimal('gpa', total: 3, places: 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('education_information');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Scholarship;
use App\Enums\BloodType;
use App\Enums\Religion;
use App\Enums\ShirtSize;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nationality', length: 3);
            $table->foreign('nationality')->references('code')->on('countries');
            $table->string('ethnicity', length: 3);
            $table->foreign('ethnicity')->references('code')->on('countries');
            $table->date('birth_date');
            $table->smallInteger('weight');
            $table->smallInteger('height');
            $table->string('email', length: 70)->unique()->nullable();
            $table->enum('scholarship', [Scholarship::YES, Scholarship::NO])->default(Scholarship::NO);
            $table->string('disability')->nullable();
            $table->enum('blood_type', [BloodType::A, BloodType::AB, BloodType::B, BloodType::O]);
            $table->enum('religion', [Religion::BUDDHISM, Religion::CHRISTIANITY, Religion::ISLAM, Religion::HINDUISM, Religion::JUDAISM, Religion::SIKHISM]);
            $table->enum('shirt_size', [ShirtSize::XXS, ShirtSize::XS, ShirtSize::S, ShirtSize::M, ShirtSize::L, ShirtSize::XL, ShirtSize::XXL]);
            $table->string('interest')->nullable();
            $table->string('address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
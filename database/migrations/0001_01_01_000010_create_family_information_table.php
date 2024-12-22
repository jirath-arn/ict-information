<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Life;
use App\Enums\Income;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('family_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('family_status_id')->unsigned()->nullable();
            $table->foreign('family_status_id')->references('id')->on('family_status');

            $table->string('father_first_name_th', length: 50)->nullable();
            $table->string('father_last_name_th', length: 50)->nullable();
            $table->string('father_first_name_en', length: 50)->nullable();
            $table->string('father_last_name_en', length: 50)->nullable();
            $table->enum('father_life', [Life::YES, Life::NO])->nullable();
            $table->enum('father_income', [Income::LOW, Income::MEDIUM, Income::HIGH])->nullable();
            $table->bigInteger('father_career_id')->unsigned()->nullable();
            $table->foreign('father_career_id')->references('id')->on('careers');

            $table->string('mother_first_name_th', length: 50)->nullable();
            $table->string('mother_last_name_th', length: 50)->nullable();
            $table->string('mother_first_name_en', length: 50)->nullable();
            $table->string('mother_last_name_en', length: 50)->nullable();
            $table->enum('mother_life', [Life::YES, Life::NO])->nullable();
            $table->enum('mother_income', [Income::LOW, Income::MEDIUM, Income::HIGH])->nullable();
            $table->bigInteger('mother_career_id')->unsigned()->nullable();
            $table->foreign('mother_career_id')->references('id')->on('careers');

            $table->string('relative_first_name_th', length: 50)->nullable();
            $table->string('relative_last_name_th', length: 50)->nullable();
            $table->string('relative_first_name_en', length: 50)->nullable();
            $table->string('relative_last_name_en', length: 50)->nullable();
            $table->enum('relative_life', [Life::YES, Life::NO])->nullable();
            $table->string('relative_address')->nullable();
            $table->enum('relative_income', [Income::LOW, Income::MEDIUM, Income::HIGH])->nullable();
            $table->bigInteger('relationship_id')->unsigned()->nullable();
            $table->foreign('relationship_id')->references('id')->on('relationships');
            $table->bigInteger('relative_career_id')->unsigned()->nullable();
            $table->foreign('relative_career_id')->references('id')->on('careers');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('family_information');
    }
};

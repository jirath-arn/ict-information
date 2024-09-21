<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StudentStatusSeeder::class,
            CountrySeeder::class,
            StudentInformationSeeder::class,
            PersonalInformationSeeder::class,
            EducationInformationSeeder::class
        ]);
    }
}

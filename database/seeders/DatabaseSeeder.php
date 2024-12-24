<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->call([
                AdminSeeder::class,
                StudentStatusSeeder::class,
                CountrySeeder::class,
                RelationshipSeeder::class,
                FamilyStatusSeeder::class,
                CareerSeeder::class
            ]);

        } else {
            $this->call([
                UserSeeder::class,
                StudentStatusSeeder::class,
                CountrySeeder::class,
                StudentInformationSeeder::class,
                PersonalInformationSeeder::class,
                EducationInformationSeeder::class,
                RelationshipSeeder::class,
                FamilyStatusSeeder::class,
                CareerSeeder::class,
                FamilyInformationSeeder::class
            ]);
        }
    }
}

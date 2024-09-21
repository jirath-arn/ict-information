<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationInformation;
use App\Enums\Education;

class EducationInformationSeeder extends Seeder
{
    public function run(): void
    {
        $education_information = [
            [
                'id' => 1,
                'user_id' => 5,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.94,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 6,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.36,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 7,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.81,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'user_id' => 8,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'user_id' => 9,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.03,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'user_id' => 10,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.71,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'user_id' => 11,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.16,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'user_id' => 12,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.97,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'user_id' => 13,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.79,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'user_id' => 14,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.83,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'user_id' => 15,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.73,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'user_id' => 16,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.21,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'user_id' => 17,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.62,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'user_id' => 18,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.42,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'user_id' => 19,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.97,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'user_id' => 20,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.66,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'user_id' => 21,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.82,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'user_id' => 22,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.22,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'user_id' => 23,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.39,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'user_id' => 24,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.69,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'user_id' => 25,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.82,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 22,
                'user_id' => 26,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.65,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 23,
                'user_id' => 27,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.93,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 24,
                'user_id' => 28,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.09,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 25,
                'user_id' => 29,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.45,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 26,
                'user_id' => 30,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.02,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 27,
                'user_id' => 31,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.29,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 28,
                'user_id' => 32,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.07,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 29,
                'user_id' => 33,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.93,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 30,
                'user_id' => 34,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.04,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 31,
                'user_id' => 35,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.64,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 32,
                'user_id' => 36,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.52,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 33,
                'user_id' => 37,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.86,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 34,
                'user_id' => 38,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.37,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 35,
                'user_id' => 39,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.66,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 36,
                'user_id' => 40,
                'education' => Education::SECONDARY_6,
                'name_school' => 'โรงเรียน',
                'qualification' => 'วิทย์-คณิต',
                'graduate_year' => '2020',
                'gpa' => 3.97,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        EducationInformation::insert($education_information);
    }
}

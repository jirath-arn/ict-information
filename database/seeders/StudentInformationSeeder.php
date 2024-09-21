<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentInformation;
use App\Enums\Transfer;

class StudentInformationSeeder extends Seeder
{
    public function run(): void
    {
        $student_information = [
            [
                'id' => 1,
                'user_id' => 5,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'user_id' => 6,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'user_id' => 7,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'user_id' => 8,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'user_id' => 9,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'user_id' => 10,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'user_id' => 11,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'user_id' => 12,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'user_id' => 13,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'user_id' => 14,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 11,
                'user_id' => 15,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 12,
                'user_id' => 16,
                'advisor_id' => 2,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 13,
                'user_id' => 17,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 14,
                'user_id' => 18,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 15,
                'user_id' => 19,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 16,
                'user_id' => 20,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 17,
                'user_id' => 21,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 18,
                'user_id' => 22,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 19,
                'user_id' => 23,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 20,
                'user_id' => 24,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 21,
                'user_id' => 25,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 22,
                'user_id' => 26,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 23,
                'user_id' => 27,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 24,
                'user_id' => 28,
                'advisor_id' => 3,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 25,
                'user_id' => 29,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 26,
                'user_id' => 30,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 27,
                'user_id' => 31,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 28,
                'user_id' => 32,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 29,
                'user_id' => 33,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 30,
                'user_id' => 34,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 31,
                'user_id' => 35,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 32,
                'user_id' => 36,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 33,
                'user_id' => 37,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 34,
                'user_id' => 38,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::NORMAL,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 35,
                'user_id' => 39,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 36,
                'user_id' => 40,
                'advisor_id' => 4,
                'student_status_code' => '10',
                'level' => 4,
                'year' => '2024',
                'transfer' => Transfer::TRANSFER,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        StudentInformation::insert($student_information);
    }
}

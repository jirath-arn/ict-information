<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Relationship;

class RelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $relationships = [
            [
                'id' => 1,
                'title' => 'บิดา'
            ],
            [
                'id' => 2,
                'title' => 'มารดา'
            ],
            [
                'id' => 3,
                'title' => 'ลุง'
            ],
            [
                'id' => 4,
                'title' => 'ป้า'
            ],
            [
                'id' => 5,
                'title' => 'น้า'
            ],
            [
                'id' => 6,
                'title' => 'อา'
            ],
            [
                'id' => 7,
                'title' => 'ปู่'
            ],
            [
                'id' => 8,
                'title' => 'ย่า'
            ],
            [
                'id' => 9,
                'title' => 'ตา'
            ],
            [
                'id' => 10,
                'title' => 'ยาย'
            ],
            [
                'id' => 11,
                'title' => 'พ่อบุญธรรม'
            ],
            [
                'id' => 12,
                'title' => 'แม่บุญธรรม'
            ],
            [
                'id' => 13,
                'title' => 'พี่สาว'
            ],
            [
                'id' => 14,
                'title' => 'พี่ชาย'
            ],
            [
                'id' => 15,
                'title' => 'อื่นๆ'
            ]
        ];

        Relationship::insert($relationships);
    }
}

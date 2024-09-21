<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FamilyStatus;

class FamilyStatusSeeder extends Seeder
{
    public function run(): void
    {
        $family_status = [
            [
                'id' => 1,
                'title' => 'อยู่ด้วยกัน'
            ],
            [
                'id' => 2,
                'title' => 'แยกกันอยู่'
            ],
            [
                'id' => 3,
                'title' => 'หย่าร้าง'
            ],
            [
                'id' => 4,
                'title' => 'บิดาถึงแก่กรรม'
            ],
            [
                'id' => 5,
                'title' => 'มารดาถึงแก่กรรม'
            ],
            [
                'id' => 6,
                'title' => 'บิดาและมารดาถึงแก่กรรม'
            ],
            [
                'id' => 7,
                'title' => 'บิดาแต่งงานใหม่'
            ],
            [
                'id' => 8,
                'title' => 'มารดาแต่งงานใหม่'
            ],
            [
                'id' => 9,
                'title' => 'บิดาและมารดาแต่งงานใหม่'
            ]
        ];

        FamilyStatus::insert($family_status);
    }
}

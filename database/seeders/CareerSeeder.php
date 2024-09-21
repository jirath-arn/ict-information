<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'id' => 1,
                'title' => 'รับราชการ'
            ],
            [
                'id' => 2,
                'title' => 'รัฐวิสาหกิจ'
            ],
            [
                'id' => 3,
                'title' => 'พนักงานเอกชน'
            ],
            [
                'id' => 4,
                'title' => 'ค้าขาย'
            ],
            [
                'id' => 5,
                'title' => 'ธุรกิจส่วนตัว'
            ],
            [
                'id' => 6,
                'title' => 'เกษตร'
            ],
            [
                'id' => 7,
                'title' => 'ประมง'
            ],
            [
                'id' => 8,
                'title' => 'พนักงานราชการ'
            ],
            [
                'id' => 9,
                'title' => 'อาชีพอิสระ'
            ],
            [
                'id' => 10,
                'title' => 'ไม่มีรายได้'
            ],
            [
                'id' => 11,
                'title' => 'อื่นๆ'
            ]
        ];

        Career::insert($careers);
    }
}

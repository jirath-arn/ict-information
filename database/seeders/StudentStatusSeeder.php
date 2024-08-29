<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentStatus;

class StudentStatusSeeder extends Seeder
{
    public function run(): void
    {
        $student_status = [
            [
                'code'          => '10',
                'title'         => 'ปกติ',
                'created_at'    => now()
            ],
            [
                'code'          => '11',
                'title'         => 'รักษาสภาพนักศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '12',
                'title'         => 'ลาพักการศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '13',
                'title'         => 'ลงทะเบียนเรียนต่างวิทยาเขต',
                'created_at'    => now()
            ],
            [
                'code'          => '40',
                'title'         => 'สำเร็จการศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '50',
                'title'         => 'ระงับใบกรอกเกรด',
                'created_at'    => now()
            ],
            [
                'code'          => '60',
                'title'         => 'ลาออก',
                'created_at'    => now()
            ],
            [
                'code'          => '61',
                'title'         => 'ย้ายวิทยาเขต',
                'created_at'    => now()
            ],
            [
                'code'          => '62',
                'title'         => 'ย้ายสถานศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '63',
                'title'         => 'ขอเรียนร่วมกับวิทยาเขตอื่น',
                'created_at'    => now()
            ],
            [
                'code'          => '64',
                'title'         => 'ถูกสั่งพักการเรียน',
                'created_at'    => now()
            ],
            [
                'code'          => '65',
                'title'         => 'โอนย้ายสาขาวิชา',
                'created_at'    => now()
            ],
            [
                'code'          => '66',
                'title'         => 'เปลี่ยนรหัส',
                'created_at'    => now()
            ],
            [
                'code'          => '67',
                'title'         => 'ฝากเรียน',
                'created_at'    => now()
            ],
            [
                'code'          => '68',
                'title'         => 'เยียวยาอุเทนถวาย',
                'created_at'    => now()
            ],
            [
                'code'          => '70',
                'title'         => 'พ้นสภาพนักศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '80',
                'title'         => 'ถอนชื่อออกจากทะเบียนนักศึกษา',
                'created_at'    => now()
            ],
            [
                'code'          => '81',
                'title'         => 'ถอนชื่อออกจากทะเบียนนักศึกษาเนื่องจากขาดคุณสมบัติ',
                'created_at'    => now()
            ],
            [
                'code'          => '82',
                'title'         => 'ให้ออก',
                'created_at'    => now()
            ],
            [
                'code'          => '83',
                'title'         => 'สละสิทธิ์',
                'created_at'    => now()
            ],
            [
                'code'          => '84',
                'title'         => 'คัดชื่อออก',
                'created_at'    => now()
            ],
            [
                'code'          => '85',
                'title'         => 'เสียชีวิต',
                'created_at'    => now()
            ],
            [
                'code'          => '90',
                'title'         => 'ยังไม่มารายงานตัว',
                'created_at'    => now()
            ],
            [
                'code'          => '91',
                'title'         => 'ยังไม่ใช้',
                'created_at'    => now()
            ],
            [
                'code'          => '92',
                'title'         => 'Convert มาจากวิทยาเขตจักพงรหัสซ้ำ',
                'created_at'    => now()
            ],
            [
                'code'          => '93',
                'title'         => 'Convert มาจากวิทยาเขตจันทบุรีรหัสซ้ำ',
                'created_at'    => now()
            ],
            [
                'code'          => '99',
                'title'         => 'ไม่ระบุ',
                'created_at'    => now()
            ]
        ];

        StudentStatus::insert($student_status);
    }
}

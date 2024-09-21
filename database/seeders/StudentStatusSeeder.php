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
                'code' => '10',
                'title' => 'ปกติ'
            ],
            [
                'code' => '11',
                'title' => 'รักษาสภาพนักศึกษา'
            ],
            [
                'code' => '12',
                'title' => 'ลาพักการศึกษา'
            ],
            [
                'code' => '13',
                'title' => 'ลงทะเบียนเรียนต่างวิทยาเขต'
            ],
            [
                'code' => '40',
                'title' => 'สำเร็จการศึกษา'
            ],
            [
                'code' => '50',
                'title' => 'ระงับใบกรอกเกรด'
            ],
            [
                'code' => '60',
                'title' => 'ลาออก'
            ],
            [
                'code' => '61',
                'title' => 'ย้ายวิทยาเขต'
            ],
            [
                'code' => '62',
                'title' => 'ย้ายสถานศึกษา'
            ],
            [
                'code' => '63',
                'title' => 'ขอเรียนร่วมกับวิทยาเขตอื่น'
            ],
            [
                'code' => '64',
                'title' => 'ถูกสั่งพักการเรียน'
            ],
            [
                'code' => '65',
                'title' => 'โอนย้ายสาขาวิชา'
            ],
            [
                'code' => '66',
                'title' => 'เปลี่ยนรหัส'
            ],
            [
                'code' => '67',
                'title' => 'ฝากเรียน'
            ],
            [
                'code' => '68',
                'title' => 'เยียวยาอุเทนถวาย'
            ],
            [
                'code' => '70',
                'title' => 'พ้นสภาพนักศึกษา'
            ],
            [
                'code' => '80',
                'title' => 'ถอนชื่อออกจากทะเบียนนักศึกษา'
            ],
            [
                'code' => '81',
                'title' => 'ถอนชื่อออกจากทะเบียนนักศึกษาเนื่องจากขาดคุณสมบัติ'
            ],
            [
                'code' => '82',
                'title' => 'ให้ออก'
            ],
            [
                'code' => '83',
                'title' => 'สละสิทธิ์'
            ],
            [
                'code' => '84',
                'title' => 'คัดชื่อออก'
            ],
            [
                'code' => '85',
                'title' => 'เสียชีวิต'
            ],
            [
                'code' => '90',
                'title' => 'ยังไม่มารายงานตัว'
            ],
            [
                'code' => '91',
                'title' => 'ยังไม่ใช้'
            ],
            [
                'code' => '92',
                'title' => 'Convert มาจากวิทยาเขตจักพงรหัสซ้ำ'
            ],
            [
                'code' => '93',
                'title' => 'Convert มาจากวิทยาเขตจันทบุรีรหัสซ้ำ'
            ],
            [
                'code' => '99',
                'title' => 'ไม่ระบุ'
            ]
        ];

        StudentStatus::insert($student_status);
    }
}

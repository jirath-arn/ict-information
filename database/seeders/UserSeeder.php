<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Status;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = 'P@ssw0rd';
        $users = [
            [
                'id'            => 1,
                'username'      => '100000000000-0',
                'password'      => Hash::make($password),
                'first_name_th' => 'สมหญิง',
                'last_name_th'  => 'สุดสวย',
                'prefix'        => Prefix::MISS,
                'first_name_en' => 'Somying',
                'last_name_en'  => 'Sudsuay',
                'rmutto_email'  => 'somying-sud@rmutto.ac.th',
                'tel'           => null,
                'role'          => Role::TEACHER,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 2,
                'username'      => '200000000000-0',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MR,
                'first_name_en' => 'Athiset',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 3,
                'username'      => '200000000000-1',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์1',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MISS,
                'first_name_en' => 'Athiset1',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset1-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 4,
                'username'      => '200000000000-2',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์2',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MRS,
                'first_name_en' => 'Athiset2',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset2-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 5,
                'username'      => '200000000000-3',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์3',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MR,
                'first_name_en' => 'Athiset3',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset3-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 6,
                'username'      => '200000000000-4',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์4',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MISS,
                'first_name_en' => 'Athiset4',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset4-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 7,
                'username'      => '200000000000-5',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์5',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MRS,
                'first_name_en' => 'Athiset5',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset5-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 8,
                'username'      => '200000000000-6',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์6',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MR,
                'first_name_en' => 'Athiset6',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset6-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 9,
                'username'      => '200000000000-7',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์7',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MISS,
                'first_name_en' => 'Athiset7',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset7-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'id'            => 10,
                'username'      => '200000000000-8',
                'password'      => Hash::make($password),
                'first_name_th' => 'อธิษเศรษฐ์8',
                'last_name_th'  => 'จันทจำรัสปัญญา',
                'prefix'        => Prefix::MRS,
                'first_name_en' => 'Athiset8',
                'last_name_en'  => 'Chantachumratpanya',
                'rmutto_email'  => 'athiset8-cha@rmutto.ac.th',
                'tel'           => '0925371266',
                'role'          => Role::STUDENT,
                'status'        => Status::ENABLE,
                'created_at'    => now(),
                'updated_at'    => now()
            ]
        ];

        User::insert($users);
    }
}

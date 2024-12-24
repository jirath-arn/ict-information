<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\Prefix;
use App\Enums\Role;
use App\Enums\Status;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $password = 'P@ssw0rd';
        $users = [
            [
                'id' => 1,
                'username' => 'admin_rmutto',
                'password' => Hash::make($password),
                'first_name_th' => 'แอดมิน',
                'last_name_th' => 'Rmutto',
                'prefix' => Prefix::MR,
                'first_name_en' => 'Admin',
                'last_name_en' => 'Rmutto',
                'rmutto_email' => 'saraban@rmutto.ac.th',
                'tel' => '033136099',
                'role' => Role::ADMIN,
                'status' => Status::ENABLE,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        User::insert($users);
    }
}

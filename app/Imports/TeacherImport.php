<?php

namespace App\Imports;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Enums\Role;
use App\Enums\Status;
use App\Models\User;
use App\Helpers\Auth;

class TeacherImport implements ToCollection, WithStartRow
{
    public function collection(Collection $rows)
    {
        try {
            foreach ($rows as $row) {
                $first_name_en = strtolower($row[3]);
                $last_name_en = strtolower($row[4]);
                $short_name = $first_name_en.'.'.substr($last_name_en, 0, 3);
                $rmutto_email = User::where('rmutto_email', '=', $short_name.'@rmutto.ac.th')
                                    ->count() ? $first_name_en.'.'.$last_name_en : $short_name;
                $number = User::selectRaw('username as number')
                            ->whereRaw('role = ?', [Role::TEACHER])
                            ->orderByRaw('username DESC')
                            ->first()
                            ->number ?? '000000000';

                $user = new User();
                $user->username = sprintf('%09d', ((int) $number + 1));
                $user->password = Hash::make($short_name);
                $user->first_name_th = $row[1];
                $user->last_name_th = $row[2];
                $user->prefix = Auth::convertPrefixFromTHToEN($row[0]);
                $user->first_name_en = ucfirst($first_name_en);
                $user->last_name_en = ucfirst($last_name_en);
                $user->rmutto_email = $rmutto_email.'@rmutto.ac.th';
                $user->tel = ($row[5] == '-') ? null : $row[5];
                $user->role = Role::TEACHER;
                $user->status = Status::ENABLE;
                $user->save();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function startRow(): int
    {
        return 2;
    }
}

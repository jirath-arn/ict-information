<?php

namespace App\Imports;

use Exception;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Enums\Role;
use App\Enums\Status;
use App\Enums\Scholarship;
use App\Models\EducationInformation;
use App\Models\FamilyInformation;
use App\Models\PersonalInformation;
use App\Models\StudentInformation;
use App\Models\User;
use App\Helpers\Auth;
use App\Helpers\Date;

class StudentImport implements ToCollection, WithStartRow, WithValidation
{
    use Importable;

    public function collection(Collection $rows)
    {
        try {
            foreach ($rows as $row) {
                $year = substr($row[7], -2);
                $first_name_en = strtolower($row[3]);
                $last_name_en = strtolower($row[4]);
                $short_name = $first_name_en.'.'.substr($last_name_en, 0, 3);
                $rmutto_email = User::where('rmutto_email', '=', $short_name.'@rmutto.ac.th')
                                    ->count() ? $first_name_en.'.'.$last_name_en : $short_name;
                $number = User::selectRaw('SUBSTRING(username, 10, 3) as number')
                            ->whereRaw('SUBSTRING(username, 3, 2) = ?', [$year])
                            ->orderByRaw('username DESC')
                            ->first()
                            ->number ?? '000';
                $advisor_id = User::selectRaw('id')
                                ->whereRaw('username = ?', $row[9])
                                ->first()
                                ->id ?? null;

                // User.
                $user = new User();
                $user->username = '01'.$year.'40664'.sprintf('%03d', ((int) $number + 1)).'-'.rand(0, 9);
                $user->password = Hash::make($short_name);
                $user->first_name_th = $row[1];
                $user->last_name_th = $row[2];
                $user->prefix = Auth::convertPrefixFromTHToEN($row[0]);
                $user->first_name_en = ucfirst($first_name_en);
                $user->last_name_en = ucfirst($last_name_en);
                $user->rmutto_email = $rmutto_email.'@rmutto.ac.th';
                $user->role = Role::STUDENT;
                $user->status = Status::ENABLE;
                $user->save();

                // Student.
                $student = new StudentInformation();
                $student->user_id = $user->id;
                $student->advisor_id = $advisor_id;
                $student->student_status_code = $row[5];
                $student->level = $row[6];            
                $student->year = Date::convertFromBEToAD($row[7]);
                $student->transfer = Auth::convertTransferFromTHToEN($row[8]);
                $student->save();

                // Personal.
                $personal = new PersonalInformation();
                $personal->user_id = $user->id;
                $personal->scholarship = Scholarship::NO;
                $personal->save();

                // Family.
                $family = new FamilyInformation();
                $family->user_id = $user->id;
                $family->save();

                // Education.
                $education = new EducationInformation();
                $education->user_id = $user->id;
                $education->save();
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '6' => Rule::in([1, 2, 3, 4, 5, 6, 7, 8])
        ];
    }
}

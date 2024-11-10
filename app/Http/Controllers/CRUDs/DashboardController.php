<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\PersonalInformation;
use App\Models\EducationInformation;
use App\Models\StudentInformation;
use App\Models\StudentStatus;
use App\Enums\ShirtSize;
use App\Enums\Religion;
use App\Enums\Education;
use App\Enums\Transfer;
use App\Enums\Status;
use App\Enums\Scholarship;
use App\Helpers\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        $info = new \stdClass();
        $info->shirt_size = $this->getShirtSize();
        $info->religion = $this->getReligion();
        $info->education = $this->getEducation();
        $info->student_status = $this->getStudentStatus();
        $info->level_year = $this->getLevelYear();
        $info->student = $this->getStudent();
        $info->scholarship = $this->getScholarship();
        $info->student_type = $this->getStudentType();

        return view('cruds.dashboard.index', compact('info'));
    }

    private function getShirtSize(): \stdClass
    {
        $shirt_size = new \stdClass();
        $shirt_size->labels = ShirtSize::getKeys();
        $shirt_size->data = array_fill(0, count($shirt_size->labels), 0);

        $shirt_group = PersonalInformation::selectRaw('shirt_size, COUNT(*) as count')
            ->leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->where('users.status', '=', Status::ENABLE)
            ->groupBy('shirt_size')
            ->get();
        foreach($shirt_group as $row) {
            $idx = array_search($row->shirt_size->value, $shirt_size->labels);
            $shirt_size->data[$idx] = $row->count;
        }

        return $shirt_size;
    }

    private function getReligion(): \stdClass
    {
        $religion = new \stdClass();
        $religion->labels = Religion::getKeys();
        $religion->data = array_fill(0, count($religion->labels), 0);

        $religion_group = PersonalInformation::selectRaw('religion, COUNT(*) as count')
            ->leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->where('users.status', '=', Status::ENABLE)
            ->groupBy('religion')
            ->get();
        foreach($religion_group as $row) {
            $idx = array_search($row->religion->value, $religion->labels);
            $religion->data[$idx] = $row->count;
        }

        for($i = 0; $i < count($religion->labels); $i++) {
            $religion->labels[$i] = Auth::convertReligionFromENToTH($religion->labels[$i]);
        }

        return $religion;
    }

    private function getEducation(): \stdClass
    {
        $education = new \stdClass();
        $education->labels = Education::getKeys();
        $education->data = array_fill(0, count($education->labels), 0);

        $education_group = EducationInformation::selectRaw('education, COUNT(*) as count')
            ->leftJoin('users', 'education_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->where('users.status', '=', Status::ENABLE)
            ->groupBy('education')
            ->get();
        foreach($education_group as $row) {
            $idx = array_search($row->education->value, $education->labels);
            $education->data[$idx] = $row->count;
        }

        for($i = 0; $i < count($education->labels); $i++) {
            $education->labels[$i] = Auth::convertEducationFromENToTH($education->labels[$i]);
        }

        return $education;
    }

    private function getStudentStatus(): \stdClass
    {
        $student_status = new \stdClass();
        $student_status->labels = array();
        $student_status->data = array();

        $status_group = StudentStatus::selectRaw('student_status.code, COUNT(*) as count')
            ->leftJoin('student_information', 'student_information.student_status_code', '=', 'student_status.code')
            ->leftJoin('users', 'users.id', '=', 'student_information.user_id')
            ->where('users.status', '=', Status::ENABLE)
            ->groupBy('student_status.code')
            ->get();
        $status_all = StudentStatus::orderBy('title')->get();
        $group = array();

        foreach($status_group as $row) {
            $group[$row->code] = $row->count;
        }
        foreach($status_all as $row) {
            $student_status->labels[] = $row->title;
            $student_status->data[] = isset($group[$row->code]) ? $group[$row->code] : 0;
        }

        return $student_status;
    }

    private function getLevelYear(): \stdClass
    {
        $level_year = new \stdClass();
        $level_year->data = array_fill(0, 8, 0);

        $level_group = StudentInformation::selectRaw('student_information.level')
            ->leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->get();
        foreach($level_group as $row) {
            $level_year->data[$row->level - 1] += 1;
        }

        return $level_year;
    }

    private function getStudent(): \stdClass
    {
        $student = new \stdClass();
        $student->new = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('student_information.level', '=', 1)
                        ->where('student_information.transfer', '=', Transfer::NORMAL);
                })->orWhere(function ($query) {
                    $query->where('student_information.level', '=', 3)
                        ->where('student_information.transfer', '=', Transfer::TRANSFER);
                });
            })->count();
        $student->studying = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->count();
        $student->graduated = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->where('student_information.student_status_code', '=', '40')
            ->count();

        return $student;
    }

    private function getScholarship(): \stdClass
    {
        $scholarship = new \stdClass();
        $scholarship->received = PersonalInformation::leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->where('users.status', '=', Status::ENABLE)
            ->where('personal_information.scholarship', '=', Scholarship::YES)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->count();
        $scholarship->not_funded = PersonalInformation::leftJoin('users', 'personal_information.user_id', '=', 'users.id')
        ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
        ->where('users.status', '=', Status::ENABLE)
        ->where('personal_information.scholarship', '=', Scholarship::NO)
        ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
        ->count();

        return $scholarship;
    }

    private function getStudentType(): \stdClass
    {
        $student_type = new \stdClass();
        $student_type->normal = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->where('student_information.transfer', '=', Transfer::NORMAL)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->count();
        $student_type->transfer = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE)
            ->where('student_information.transfer', '=', Transfer::TRANSFER)
            ->whereIn('student_information.student_status_code', ['92', '93', '63', '10', '67', '13'])
            ->count();

        return $student_type;
    }
}

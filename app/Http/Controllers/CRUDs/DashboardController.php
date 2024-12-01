<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
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
use App\Enums\Role;
use App\Helpers\Auth;

class DashboardController extends Controller
{
    private array $student_status_code = ['92', '93', '63', '10', '67', '13'];

    public function index(): View
    {
        $user_id = (Auth::getRoleEN() == Role::TEACHER) ? Auth::getId() : null;

        $info = new \stdClass();
        $info->shirt_size = $this->getShirtSize($user_id);
        $info->religion = $this->getReligion($user_id);
        $info->education = $this->getEducation($user_id);
        $info->student_status = $this->getStudentStatus($user_id);
        $info->level_year = $this->getLevelYear($user_id);
        $info->student = $this->getStudent($user_id);
        $info->scholarship = $this->getScholarship($user_id);
        $info->student_type = $this->getStudentType($user_id);

        return view('cruds.dashboard.index', compact('info'));
    }

    private function getShirtSize($user_id): \stdClass
    {
        $shirt_size = new \stdClass();
        $shirt_size->labels = ShirtSize::getKeys();
        $shirt_size->labels[] = 'ไม่ระบุ';
        $shirt_size->data = array_fill(0, count($shirt_size->labels), 0);

        $shirt_group = PersonalInformation::selectRaw('personal_information.shirt_size as shirt_size, COUNT(*) as count')
            ->leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $shirt_group = $shirt_group->where('student_information.advisor_id', '=', $user_id);

        $shirt_group = $shirt_group->groupBy('personal_information.shirt_size')->get();

        foreach($shirt_group as $row) {
            $idx = array_search($row->shirt_size->value ?? 'ไม่ระบุ', $shirt_size->labels);
            $shirt_size->data[$idx] = $row->count;
        }

        return $shirt_size;
    }

    private function getReligion($user_id): \stdClass
    {
        $religion = new \stdClass();
        $religion->labels = Religion::getKeys();
        $religion->labels[] = 'ไม่ระบุ';
        $religion->data = array_fill(0, count($religion->labels), 0);

        $religion_group = PersonalInformation::selectRaw('personal_information.religion as religion, COUNT(*) as count')
            ->leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $religion_group = $religion_group->where('student_information.advisor_id', '=', $user_id);

        $religion_group = $religion_group->groupBy('personal_information.religion')->get();

        foreach($religion_group as $row) {
            $idx = array_search($row->religion->value ?? 'ไม่ระบุ', $religion->labels);
            $religion->data[$idx] = $row->count;
        }

        for($i = 0; $i < count($religion->labels); $i++) {
            $religion->labels[$i] = Auth::convertReligionFromENToTH($religion->labels[$i]) ?? 'ไม่ระบุ';
        }

        return $religion;
    }

    private function getEducation($user_id): \stdClass
    {
        $education = new \stdClass();
        $education->labels = Education::getKeys();
        $education->labels[] = 'ไม่ระบุ';
        $education->data = array_fill(0, count($education->labels), 0);

        $education_group = EducationInformation::selectRaw('education_information.education as education, COUNT(*) as count')
            ->leftJoin('users', 'education_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $education_group = $education_group->where('student_information.advisor_id', '=', $user_id);

        $education_group = $education_group->groupBy('education_information.education')->get();

        foreach($education_group as $row) {
            $idx = array_search($row->education->value ?? 'ไม่ระบุ', $education->labels);
            $education->data[$idx] = $row->count;
        }

        for($i = 0; $i < count($education->labels); $i++) {
            $education->labels[$i] = Auth::convertEducationFromENToTH($education->labels[$i]) ?? 'ไม่ระบุ';
        }

        return $education;
    }

    private function getStudentStatus($user_id): \stdClass
    {
        $student_status = new \stdClass();
        $student_status->labels = array();
        $student_status->data = array();

        $status_group = StudentStatus::selectRaw('student_status.code as code, COUNT(*) as count')
            ->leftJoin('student_information', 'student_information.student_status_code', '=', 'student_status.code')
            ->leftJoin('users', 'users.id', '=', 'student_information.user_id')
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $status_group = $status_group->where('student_information.advisor_id', '=', $user_id);

        $status_group = $status_group->groupBy('student_status.code')->get();
        $status_all = StudentStatus::orderBy('student_status.title')->get();
        $group = array();

        foreach($status_group as $row) {
            $group[$row->code] = $row->count;
        }

        foreach($status_all as $row) {
            $student_status->labels[] = $row->title;
            $student_status->data[] = (isset($group[$row->code])) ? $group[$row->code] : 0;
        }

        return $student_status;
    }

    private function getLevelYear($user_id): \stdClass
    {
        $level_year = new \stdClass();
        $level_year->data = array_fill(0, 8, 0);

        $level_group = StudentInformation::selectRaw('student_information.level as level')
            ->leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $level_group = $level_group->where('student_information.advisor_id', '=', $user_id);

        $level_group = $level_group->get();

        foreach($level_group as $row) {
            $level_year->data[$row->level - 1] += 1;
        }

        return $level_year;
    }

    private function getStudent($user_id): \stdClass
    {
        $student = new \stdClass();
        $student->new = $this->getQueryStudentInformation($user_id)
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('student_information.level', '=', 1)
                        ->where('student_information.transfer', '=', Transfer::NORMAL);
                })->orWhere(function ($query) {
                    $query->where('student_information.level', '=', 3)
                        ->where('student_information.transfer', '=', Transfer::TRANSFER);
                });
            })
            ->count();

        $student->studying = $this->getQueryStudentInformation($user_id)
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->count();

        $student->graduated = $this->getQueryStudentInformation($user_id)
            ->where('student_information.student_status_code', '=', '40')
            ->count();

        return $student;
    }

    private function getScholarship($user_id): \stdClass
    {
        $scholarship = new \stdClass();
        $scholarship->received = $this->getQueryPersonalInformation($user_id)
            ->where('personal_information.scholarship', '=', Scholarship::YES)
            ->count();

        $scholarship->not_funded = $this->getQueryPersonalInformation($user_id)
            ->where('personal_information.scholarship', '=', Scholarship::NO)
            ->count();

        return $scholarship;
    }

    private function getStudentType($user_id): \stdClass
    {
        $student_type = new \stdClass();
        $student_type->normal = $this->getQueryStudentInformation($user_id)
            ->where('student_information.transfer', '=', Transfer::NORMAL)
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->count();

        $student_type->transfer = $this->getQueryStudentInformation($user_id)
            ->where('student_information.transfer', '=', Transfer::TRANSFER)
            ->whereIn('student_information.student_status_code', $this->student_status_code)
            ->count();

        return $student_type;
    }

    private function getQueryStudentInformation($user_id): Builder
    {
        $query = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('users.status', '=', Status::ENABLE);

        if ($user_id) $query = $query->where('student_information.advisor_id', '=', $user_id);

        return $query;
    }

    private function getQueryPersonalInformation($user_id): Builder
    {
        $query = PersonalInformation::leftJoin('users', 'personal_information.user_id', '=', 'users.id')
            ->leftJoin('student_information', 'users.id', '=', 'student_information.user_id')
            ->where('users.status', '=', Status::ENABLE)
            ->whereIn('student_information.student_status_code', $this->student_status_code);

        if ($user_id) $query = $query->where('student_information.advisor_id', '=', $user_id);

        return $query;
    }
}

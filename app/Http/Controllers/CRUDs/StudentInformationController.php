<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Helpers\Auth;
use App\Helpers\Tel;
use App\Helpers\Date;
use App\Models\StudentInformation;

class StudentInformationController extends Controller
{
    public function index(): View
    {
        $student_information = StudentInformation::where('user_id', '=', Auth::getId())->first();
        $user = $student_information->user;
        $student_status = $student_information->student_status;
        $advisor = $student_information->advisor;

        // Student Status.
        $student_status_info = new \stdClass();
        $student_status_info->title = $student_status->title;

        // Advisor.
        $advisor_info = new \stdClass();
        $advisor_info->full_name_with_prefix_th = Auth::convertPrefixFromENToTH($advisor->prefix->value) . " $advisor->first_name_th $advisor->last_name_th";
        $advisor_info->tel = Tel::format($advisor->tel);
        $advisor_info->rmutto_email = $advisor->rmutto_email;

        // User.
        $info = new \stdClass();
        $info->student_id = $user->username;
        $info->full_name_with_prefix_th = Auth::getFullNameWithPrefixTH();
        $info->full_name_with_prefix_en = Auth::getFullNameWithPrefixEN();
        $info->rmutto_email = $user->rmutto_email;
        $info->student_status = $student_status_info;
        $info->level = $student_information->level;
        $info->year = Date::convertFromADToBE($student_information->year);
        $info->advisor = $advisor_info;

        return view('cruds.student_information.index', compact('info'));
    }
}

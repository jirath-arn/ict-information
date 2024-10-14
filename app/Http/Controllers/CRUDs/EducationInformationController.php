<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Dflydev\DotAccessData\Data;
use Illuminate\View\View;
use App\Helpers\Auth;
use App\Helpers\Date;
use App\Enums\Education;
use App\Models\EducationInformation;

class EducationInformationController extends Controller
{
    public function index(): View
    {
        $education_information = EducationInformation::where('user_id', '=', Auth::getId())->first();

        $info = new \stdClass();
        $info->education = Auth::convertEducationFromENToTH($education_information->education);
        $info->name_school = $education_information->name_school;
        $info->qualification = $education_information->qualification;
        $info->graduate_year = Date::convertFromADToBE($education_information->graduate_year);
        $info->gpa = $education_information->gpa;

        return view('cruds.education_information.index', compact('info'));
    }

    public function edit($id): View
    {
        $current_year = Date::convertFromADToBE(Date::getCurrentYear());
        $education = Education::getKeys();
        $education_information = EducationInformation::where('user_id', '=', $id)->first();

        $info = new \stdClass();
        $info->education = $education_information->education;
        $info->name_school = $education_information->name_school;
        $info->qualification = $education_information->qualification;
        $info->graduate_year = Date::convertFromADToBE($education_information->graduate_year);
        $info->gpa = $education_information->gpa;

        return view('cruds.education_information.edit', compact('info', 'education', 'current_year'));
    }
}

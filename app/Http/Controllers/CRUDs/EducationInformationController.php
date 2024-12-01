<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Helpers\Auth;
use App\Helpers\Date;
use App\Enums\Education;
use App\Models\EducationInformation;

class EducationInformationController extends Controller
{
    public function index(): View
    {
        $info = $this->getInfo();
        $info->education = Auth::convertEducationFromENToTH($info->education);
        $info->graduate_year = Date::convertFromADToBE($info->graduate_year);

        return view('cruds.education_information.index', compact('info'));
    }

    public function edit(): View
    {
        $current_year = Date::getCurrentYear();
        $education = Education::getKeys();
        $info = $this->getInfo();

        return view('cruds.education_information.edit', compact('info', 'education', 'current_year'));
    }

    public function update(Request $request): Response
    {
        $current_year = Date::getCurrentYear();
        $request->validate([
            'education' => ['nullable', Rule::in(Education::getKeys())],
            'name_school' => ['nullable'],
            'qualification' => ['nullable'],
            'graduate_year' => ['nullable', 'integer', 'between:' . ($current_year - 9) . ',' . $current_year],
            'gpa' => ['nullable', 'numeric', 'between:0,4']
        ]);

        $education_information = EducationInformation::where('user_id', '=', Auth::getId())->first();
        $education_information->update($request->all());

        return redirect()->route('education_information.index');
    }

    private function getInfo(): \stdClass
    {
        $education_information = EducationInformation::where('user_id', '=', Auth::getId())->first();

        $info = new \stdClass();
        $info->education = $education_information->education;
        $info->name_school = $education_information->name_school;
        $info->qualification = $education_information->qualification;
        $info->graduate_year = $education_information->graduate_year;
        $info->gpa = $education_information->gpa;

        return $info;
    }
}

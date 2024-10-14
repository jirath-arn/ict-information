<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Helpers\Auth;
use App\Models\FamilyInformation;

class FamilyInformationController extends Controller
{
    public function index(): View
    {
        $family_information = FamilyInformation::where('user_id', '=', Auth::getId())->first();
        $family_status = $family_information->family_status;
        $father_career = $family_information->father_career;
        $mother_career = $family_information->mother_career;
        $relative_career = $family_information->relative_career;
        $relationship = $family_information->relationship;

        // Family Status.
        $family_status_info = new \stdClass();
        $family_status_info->title = $family_status->title;

        // Father Career.
        $father_career_info = new \stdClass();
        $father_career_info->title = $father_career->title;

        // Mother Career.
        $mother_career_info = new \stdClass();
        $mother_career_info->title = $mother_career->title;

        // Relative Career.
        $relative_career_info = new \stdClass();
        $relative_career_info->title = $relative_career->title;

        // Relationship.
        $relationship_info = new \stdClass();
        $relationship_info->title = $relationship->title;

        // Family Information.
        $info = new \stdClass();
        $info->family_status = $family_status_info;
        $info->father_full_name_th = "$family_information->father_first_name_th $family_information->father_last_name_th";
        $info->father_full_name_en = "$family_information->father_first_name_en $family_information->father_last_name_en";
        $info->father_life = Auth::convertLifeFromENToTH($family_information->father_life);
        $info->father_income = Auth::convertIncomeFromENToTH($family_information->father_income);
        $info->father_career = $father_career_info;
        $info->mother_full_name_th = "$family_information->mother_first_name_th $family_information->mother_last_name_th";
        $info->mother_full_name_en = "$family_information->mother_first_name_en $family_information->mother_last_name_en";
        $info->mother_life = Auth::convertLifeFromENToTH($family_information->mother_life);
        $info->mother_income = Auth::convertIncomeFromENToTH($family_information->mother_income);
        $info->mother_career = $mother_career_info;
        $info->relative_full_name_th = "$family_information->relative_first_name_th $family_information->relative_last_name_th";
        $info->relative_full_name_en = "$family_information->relative_first_name_en $family_information->relative_last_name_en";
        $info->relative_life = Auth::convertLifeFromENToTH($family_information->relative_life);
        $info->relative_income = Auth::convertIncomeFromENToTH($family_information->relative_income);
        $info->relative_career = $relative_career_info;
        $info->relationship = $relationship_info;
        $info->address = $family_information->address;

        return view('cruds.family_information.index', compact('info'));
    }
}

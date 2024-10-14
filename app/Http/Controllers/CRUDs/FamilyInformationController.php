<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Helpers\Auth;
use App\Enums\Life;
use App\Enums\Income;
use App\Models\FamilyInformation;
use App\Models\FamilyStatus;
use App\Models\Career;
use App\Models\Relationship;

class FamilyInformationController extends Controller
{
    public function index(): View
    {
        $info = $this->getInfo();
        $info->father_full_name_th = "$info->father_first_name_th $info->father_last_name_th";
        $info->father_full_name_en = "$info->father_first_name_en $info->father_last_name_en";
        $info->father_life = Auth::convertLifeFromENToTH($info->father_life);
        $info->father_income = Auth::convertIncomeFromENToTH($info->father_income);

        $info->mother_full_name_th = "$info->mother_first_name_th $info->mother_last_name_th";
        $info->mother_full_name_en = "$info->mother_first_name_en $info->mother_last_name_en";
        $info->mother_life = Auth::convertLifeFromENToTH($info->mother_life);
        $info->mother_income = Auth::convertIncomeFromENToTH($info->mother_income);

        $info->relative_full_name_th = "$info->relative_first_name_th $info->relative_last_name_th";
        $info->relative_full_name_en = "$info->relative_first_name_en $info->relative_last_name_en";
        $info->relative_life = Auth::convertLifeFromENToTH($info->relative_life);
        $info->relative_income = Auth::convertIncomeFromENToTH($info->relative_income);

        return view('cruds.family_information.index', compact('info'));
    }

    public function edit(): View
    {
        $family_status = FamilyStatus::orderBy('id', 'asc')->get();
        $careers = Career::orderBy('id', 'asc')->get();
        $relationship = Relationship::orderBy('id', 'asc')->get();
        $life = Life::getKeys();
        $income = Income::getKeys();
        $info = $this->getInfo();

        return view('cruds.family_information.edit', compact('info', 'family_status', 'life', 'income', 'careers', 'relationship'));
    }

    public function update(Request $request): Response
    {
        $request->validate([
            'family_status_id' => ['required', 'exists:family_status,id'],
            'father_first_name_th' => ['required', 'max:50'],
            'father_last_name_th' => ['required', 'max:50'],
            'father_first_name_en' => ['required', 'max:50'],
            'father_last_name_en' => ['required', 'max:50'],
            'father_life' => ['required', Rule::in(Life::getKeys())],
            'father_income' => ['required', Rule::in(Income::getKeys())],
            'father_career_id' => ['required', 'exists:careers,id'],
            'mother_first_name_th' => ['required', 'max:50'],
            'mother_last_name_th' => ['required', 'max:50'],
            'mother_first_name_en' => ['required', 'max:50'],
            'mother_last_name_en' => ['required', 'max:50'],
            'mother_life' => ['required', Rule::in(Life::getKeys())],
            'mother_income' => ['required', Rule::in(Income::getKeys())],
            'mother_career_id' => ['required', 'exists:careers,id'],
            'relative_first_name_th' => ['required', 'max:50'],
            'relative_last_name_th' => ['required', 'max:50'],
            'relative_first_name_en' => ['required', 'max:50'],
            'relative_last_name_en' => ['required', 'max:50'],
            'relationship_id' => ['required', 'exists:relationships,id'],
            'relative_life' => ['required', Rule::in(Life::getKeys())],
            'relative_income' => ['required', Rule::in(Income::getKeys())],
            'relative_career_id' => ['required', 'exists:careers,id'],
            'address' => ['required']
        ]);

        $family_information = FamilyInformation::where('user_id', '=', Auth::getId())->first();
        $family_information->update($request->all());

        return redirect()->route('family_information.index');
    }

    private function getInfo(): \stdClass
    {
        $family_information = FamilyInformation::where('user_id', '=', Auth::getId())->first();
        $family_status = $family_information->family_status;
        $father_career = $family_information->father_career;
        $mother_career = $family_information->mother_career;
        $relative_career = $family_information->relative_career;
        $relationship = $family_information->relationship;

        // Family Status.
        $family_status_info = new \stdClass();
        $family_status_info->id = $family_status->id;
        $family_status_info->title = $family_status->title;

        // Father Career.
        $father_career_info = new \stdClass();
        $father_career_info->id = $father_career->id;
        $father_career_info->title = $father_career->title;

        // Mother Career.
        $mother_career_info = new \stdClass();
        $mother_career_info->id = $mother_career->id;
        $mother_career_info->title = $mother_career->title;

        // Relative Career.
        $relative_career_info = new \stdClass();
        $relative_career_info->id = $relative_career->id;
        $relative_career_info->title = $relative_career->title;

        // Relationship.
        $relationship_info = new \stdClass();
        $relationship_info->id = $relationship->id;
        $relationship_info->title = $relationship->title;

        // Family Information.
        $info = new \stdClass();
        $info->family_status = $family_status_info;
        $info->father_first_name_th = $family_information->father_first_name_th;
        $info->father_last_name_th = $family_information->father_last_name_th;
        $info->father_first_name_en = $family_information->father_first_name_en;
        $info->father_last_name_en = $family_information->father_last_name_en;
        $info->father_life = $family_information->father_life;
        $info->father_income = $family_information->father_income;
        $info->father_career = $father_career_info;

        $info->mother_first_name_th = $family_information->mother_first_name_th;
        $info->mother_last_name_th = $family_information->mother_last_name_th;
        $info->mother_first_name_en = $family_information->mother_first_name_en;
        $info->mother_last_name_en = $family_information->mother_last_name_en;
        $info->mother_life = $family_information->mother_life;
        $info->mother_income = $family_information->mother_income;
        $info->mother_career = $mother_career_info;

        $info->relative_first_name_th = $family_information->relative_first_name_th;
        $info->relative_last_name_th = $family_information->relative_last_name_th;
        $info->relative_first_name_en = $family_information->relative_first_name_en;
        $info->relative_last_name_en = $family_information->relative_last_name_en;
        $info->relative_life = $family_information->relative_life;
        $info->relative_income = $family_information->relative_income;
        $info->relative_career = $relative_career_info;
        $info->relationship = $relationship_info;
        $info->address = $family_information->address;

        return $info;
    }
}

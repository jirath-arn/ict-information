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
        $info->father_full_name_th = (isset($info->father_first_name_th) && isset($info->father_last_name_th))
            ? "$info->father_first_name_th $info->father_last_name_th" : null;
        $info->father_full_name_en = (isset($info->father_first_name_en) && isset($info->father_last_name_en))
            ? "$info->father_first_name_en $info->father_last_name_en" : null;
        $info->father_life = Auth::convertLifeFromENToTH($info->father_life);
        $info->father_income = Auth::convertIncomeFromENToTH($info->father_income);

        $info->mother_full_name_th = (isset($info->mother_first_name_th) && isset($info->mother_last_name_th))
            ? "$info->mother_first_name_th $info->mother_last_name_th" : null;
        $info->mother_full_name_en = (isset($info->mother_first_name_en) && isset($info->mother_last_name_en))
            ? "$info->mother_first_name_en $info->mother_last_name_en" : null;
        $info->mother_life = Auth::convertLifeFromENToTH($info->mother_life);
        $info->mother_income = Auth::convertIncomeFromENToTH($info->mother_income);

        $info->relative_full_name_th = (isset($info->relative_first_name_th) && isset($info->relative_last_name_th))
            ? "$info->relative_first_name_th $info->relative_last_name_th" : null;
        $info->relative_full_name_en = (isset($info->relative_first_name_en) && isset($info->relative_last_name_en))
            ? "$info->relative_first_name_en $info->relative_last_name_en" : null;
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
            'family_status_id' => ['nullable', 'exists:family_status,id'],
            'father_first_name_th' => ['nullable', 'max:50'],
            'father_last_name_th' => ['nullable', 'max:50'],
            'father_first_name_en' => ['nullable', 'max:50'],
            'father_last_name_en' => ['nullable', 'max:50'],
            'father_life' => ['nullable', Rule::in(Life::getKeys())],
            'father_income' => ['nullable', Rule::in(Income::getKeys())],
            'father_career_id' => ['nullable', 'exists:careers,id'],
            'mother_first_name_th' => ['nullable', 'max:50'],
            'mother_last_name_th' => ['nullable', 'max:50'],
            'mother_first_name_en' => ['nullable', 'max:50'],
            'mother_last_name_en' => ['nullable', 'max:50'],
            'mother_life' => ['nullable', Rule::in(Life::getKeys())],
            'mother_income' => ['nullable', Rule::in(Income::getKeys())],
            'mother_career_id' => ['nullable', 'exists:careers,id'],
            'relative_first_name_th' => ['nullable', 'max:50'],
            'relative_last_name_th' => ['nullable', 'max:50'],
            'relative_first_name_en' => ['nullable', 'max:50'],
            'relative_last_name_en' => ['nullable', 'max:50'],
            'relationship_id' => ['nullable', 'exists:relationships,id'],
            'relative_life' => ['nullable', Rule::in(Life::getKeys())],
            'relative_income' => ['nullable', Rule::in(Income::getKeys())],
            'relative_career_id' => ['nullable', 'exists:careers,id'],
            'relative_address' => ['nullable']
        ]);

        $input = $request->all();
        $input['father_first_name_en'] = isset($request->father_first_name_en) ? ucfirst(strtolower($request->father_first_name_en)) : null;
        $input['father_last_name_en'] = isset($request->father_last_name_en) ? ucfirst(strtolower($request->father_last_name_en)) : null;
        $input['mother_first_name_en'] = isset($request->mother_first_name_en) ? ucfirst(strtolower($request->mother_first_name_en)) : null;
        $input['mother_last_name_en'] = isset($request->mother_last_name_en) ? ucfirst(strtolower($request->mother_last_name_en)) : null;
        $input['relative_first_name_en'] = isset($request->relative_first_name_en) ? ucfirst(strtolower($request->relative_first_name_en)) : null;
        $input['relative_last_name_en'] = isset($request->relative_last_name_en) ? ucfirst(strtolower($request->relative_last_name_en)) : null;
        $request->merge($input);

        $family_information = FamilyInformation::where('user_id', '=', Auth::getId())->first();
        $family_information->update($request->all());

        return redirect()->route('family_information.index');
    }

    private function getInfo(): \stdClass
    {
        $family_information = FamilyInformation::where('user_id', '=', Auth::getId())->first();

        $info = new \stdClass();
        $info->family_status = $family_information->family_status;
        $info->father_first_name_th = $family_information->father_first_name_th;
        $info->father_last_name_th = $family_information->father_last_name_th;
        $info->father_first_name_en = $family_information->father_first_name_en;
        $info->father_last_name_en = $family_information->father_last_name_en;
        $info->father_life = $family_information->father_life;
        $info->father_income = $family_information->father_income;
        $info->father_career = $family_information->father_career;

        $info->mother_first_name_th = $family_information->mother_first_name_th;
        $info->mother_last_name_th = $family_information->mother_last_name_th;
        $info->mother_first_name_en = $family_information->mother_first_name_en;
        $info->mother_last_name_en = $family_information->mother_last_name_en;
        $info->mother_life = $family_information->mother_life;
        $info->mother_income = $family_information->mother_income;
        $info->mother_career = $family_information->mother_career;

        $info->relative_first_name_th = $family_information->relative_first_name_th;
        $info->relative_last_name_th = $family_information->relative_last_name_th;
        $info->relative_first_name_en = $family_information->relative_first_name_en;
        $info->relative_last_name_en = $family_information->relative_last_name_en;
        $info->relative_life = $family_information->relative_life;
        $info->relative_income = $family_information->relative_income;
        $info->relative_career = $family_information->relative_career;
        $info->relationship = $family_information->relationship;
        $info->relative_address = $family_information->relative_address;

        return $info;
    }
}

<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
use App\Helpers\Auth;
use App\Helpers\Tel;
use App\Helpers\Date;
use App\Enums\ShirtSize;
use App\Enums\Religion;
use App\Enums\BloodType;
use App\Enums\Scholarship;
use App\Models\PersonalInformation;
use App\Models\Country;
use App\Models\User;

class PersonalInformationController extends Controller
{
    public function index(): View
    {
        $info = $this->getInfo();
        $info->birth_date = Date::convertToBirthDate($info->birth_date);
        $info->tel = Tel::format($info->tel);
        $info->scholarship = Auth::convertScholarshipFromENToTH($info->scholarship);
        $info->religion = Auth::convertReligionFromENToTH($info->religion);

        return view('cruds.personal_information.index', compact('info'));
    }

    public function edit(): View
    {
        $current_date = Date::getCurrentDateTH();
        $scholarship = Scholarship::getKeys();
        $blood_type = BloodType::getKeys();
        $religion = Religion::getKeys();
        $shirt_size = ShirtSize::getKeys();
        $countries = Country::orderBy('title', 'asc')->get();
        $info = $this->getInfo();

        $birth_datetime = new DateTime($info->birth_date);
        $thai_year = (int) $birth_datetime->format('Y') + 543;
        $info->birth_date = $birth_datetime->format('d-m-').$thai_year;

        return view('cruds.personal_information.edit', compact('info', 'shirt_size', 'religion', 'countries', 'blood_type', 'scholarship', 'current_date'));
    }

    public function update(Request $request): Response
    {
        $request->validate([
            'birth_date' => ['nullable'],
            'weight' => ['nullable', 'integer', 'between:20,200'],
            'height' => ['nullable', 'integer', 'between:100,300'],
            'email' => ['nullable', 'email:rfc,dns', 'max:70'],
            'tel' => ['nullable', 'max:10'],
            'scholarship' => ['required', Rule::in(Scholarship::getKeys())],
            'disability' => ['nullable', 'max:255'],
            'blood_type' => ['nullable', Rule::in(BloodType::getKeys())],
            'nationality' => ['nullable', 'exists:countries,code'],
            'ethnicity' => ['nullable', 'exists:countries,code'],
            'religion' => ['nullable', Rule::in(Religion::getKeys())],
            'shirt_size' => ['nullable', Rule::in(ShirtSize::getKeys())],
            'interest' => ['nullable', 'max:255'],
            'address' => ['nullable']
        ]);

        $input = $request->all();
        $birth_date = explode('-', $request->birth_date);
        $input['birth_date'] = sprintf('%04d-%02d-%02d', $birth_date[2] - 543, $birth_date[1], $birth_date[0]);
        $request->merge($input);

        $personal_information = PersonalInformation::where('user_id', '=', Auth::getId())->first();
        $personal_information->update($request->all());

        $user = User::where('id', '=', Auth::getId())->first();
        $user->tel = $request->tel;
        $user->save();

        return redirect()->route('personal_information.index');
    }

    private function getInfo(): \stdClass
    {
        $personal_information = PersonalInformation::where('user_id', '=', Auth::getId())->first();
        $nationality = $personal_information->nationality_info;
        $ethnicity = $personal_information->ethnicity_info;
        $user = $personal_information->user;

        // Nationality.
        $nationality_info = new \stdClass();
        $nationality_info->code = $nationality->code ?? null;
        $nationality_info->title = $nationality->title ?? null;

        // Ethnicity.
        $ethnicity_info = new \stdClass();
        $ethnicity_info->code = $ethnicity->code ?? null;
        $ethnicity_info->title = $ethnicity->title ?? null;

        // Personal Information.
        $info = new \stdClass();
        $info->birth_date = $personal_information->birth_date;
        $info->weight = $personal_information->weight;
        $info->height = $personal_information->height;
        $info->email = $personal_information->email;
        $info->tel = $user->tel;
        $info->scholarship = $personal_information->scholarship;
        $info->disability = $personal_information->disability;
        $info->blood_type = $personal_information->blood_type;
        $info->nationality = $nationality_info;
        $info->ethnicity = $ethnicity_info;
        $info->religion = $personal_information->religion;
        $info->shirt_size = $personal_information->shirt_size;
        $info->interest = $personal_information->interest;
        $info->address = $personal_information->address;

        return $info;
    }
}

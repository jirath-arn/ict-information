<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Helpers\Auth;
use App\Helpers\Tel;
use App\Helpers\Date;
use App\Enums\ShirtSize;
use App\Enums\Religion;
use App\Enums\BloodType;
use App\Enums\Scholarship;
use App\Models\PersonalInformation;
use App\Models\Country;

class PersonalInformationController extends Controller
{
    public function index(): View
    {
        $personal_information = PersonalInformation::where('user_id', '=', Auth::getId())->first();
        $nationality = $personal_information->nationality_info;
        $ethnicity = $personal_information->ethnicity_info;
        $user = $personal_information->user;

        // Nationality.
        $nationality_info = new \stdClass();
        $nationality_info->title = $nationality->title;

        // Ethnicity.
        $ethnicity_info = new \stdClass();
        $ethnicity_info->title = $ethnicity->title;

        // Personal Information.
        $info = new \stdClass();
        $info->birth_date = Date::convertToBirthDate($personal_information->birth_date);
        $info->weight = $personal_information->weight;
        $info->height = $personal_information->height;
        $info->email = $personal_information->email;
        $info->tel = Tel::format($user->tel);
        $info->scholarship = Auth::convertScholarshipFromENToTH($personal_information->scholarship);
        $info->disability = $personal_information->disability;
        $info->blood_type = $personal_information->blood_type;
        $info->nationality = $nationality_info;
        $info->ethnicity = $ethnicity_info;
        $info->religion = Auth::convertReligionFromENToTH($personal_information->religion);
        $info->shirt_size = $personal_information->shirt_size;
        $info->interest = $personal_information->interest;
        $info->address = $personal_information->address;

        return view('cruds.personal_information.index', compact('info'));
    }

    public function edit($id): View
    {
        $scholarship = Scholarship::getKeys();
        $blood_type = BloodType::getKeys();
        $religion = Religion::getKeys();
        $shirt_size = ShirtSize::getKeys();
        $countries = Country::all();
        $personal_information = PersonalInformation::where('user_id', '=', $id)->first();
        $nationality = $personal_information->nationality_info;
        $ethnicity = $personal_information->ethnicity_info;
        $user = $personal_information->user;

        // Nationality.
        $nationality_info = new \stdClass();
        $nationality_info->code = $nationality->code;

        // Ethnicity.
        $ethnicity_info = new \stdClass();
        $ethnicity_info->code = $ethnicity->code;

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

        return view('cruds.personal_information.edit', compact('info', 'shirt_size', 'religion', 'countries', 'blood_type', 'scholarship'));
    }
}

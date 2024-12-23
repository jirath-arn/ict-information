<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Enums\Scholarship;
use App\Enums\BloodType;
use App\Enums\Religion;
use App\Enums\ShirtSize;
use App\Enums\Life;
use App\Enums\Income;
use App\Enums\Education;
use App\Enums\Status;
use App\Enums\Role;
use App\Enums\Prefix;
use App\Enums\Transfer;
use App\Helpers\Auth;
use App\Helpers\Date;
use App\Models\EducationInformation;
use App\Models\FamilyInformation;
use App\Models\PersonalInformation;
use App\Models\StudentInformation;
use App\Models\User;
use App\Models\FamilyStatus;
use App\Models\Career;
use App\Models\Relationship;
use App\Models\Country;
use App\Models\StudentStatus;

class StudentManagementController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $search = $request->input('search', '');
        $per_page = $request->input('per_page', 5);
        $sort_by = $request->input('sort_by', 'student_id');
        $sort_direction = $request->input('sort_direction', 'asc');

        if (!in_array($per_page, [5, 10, 15, 20]) ||
            !in_array($sort_by, ['full_name_th', 'level', 'student_id', 'full_name_en']) ||
            !in_array($sort_direction, ['asc', 'desc'])) {
            return redirect()->route('student_management.index');
        }

        switch ($sort_by) {
            case "full_name_th":
                $sort_by = "users.first_name_th $sort_direction, users.last_name_th asc";
                break;
            case "level":
                $sort_by = "student_information.level $sort_direction, users.first_name_th asc, users.last_name_th asc";
                break;
            case "student_id":
                $sort_by = "users.username $sort_direction";
                break;
            case "full_name_en":
                $sort_by = "users.first_name_en $sort_direction, users.last_name_en asc";
                break;
        }

        $students = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->leftJoin('student_status', 'student_information.student_status_code', '=', 'student_status.code')
            ->where('users.status', '=', Status::ENABLE)
            ->when($search, function ($query) use ($search) {
                return $query->where('users.first_name_th', 'like', '%'.$search.'%')
                    ->orWhere('users.last_name_th', 'like', '%'.$search.'%')
                    ->orWhere('users.first_name_en', 'like', '%'.$search.'%')
                    ->orWhere('users.last_name_en', 'like', '%'.$search.'%')
                    ->orWhere('users.username', 'like', '%'.$search.'%')
                    ->orWhere('student_status.title', 'like', '%'.$search.'%');
            });

        if (Auth::getRoleEN() == Role::TEACHER) $students = $students->where('student_information.advisor_id', '=', Auth::getId());

        $students = $students->orderByRaw($sort_by)
            ->paginate($per_page);

        return view('cruds.student_management.index', compact('students'));
    }

    public function create(): View
    {
        $current_year = Date::getCurrentYear();
        $prefix = Prefix::getKeys();
        $transfer = Transfer::getKeys();
        $student_status = StudentStatus::orderBy('title', 'asc')->get();
        $advisors = User::selectRaw('id, first_name_th, last_name_th')
            ->where('role', '=', Role::TEACHER)
            ->where('status', '=', Status::ENABLE)
            ->orderByRaw('first_name_th asc, last_name_th asc')
            ->get();

        return view('cruds.student_management.create', compact('prefix', 'student_status', 'current_year', 'transfer', 'advisors'));
    }

    public function store(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'prefix' => ['required', Rule::in(Prefix::getKeys())],
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50', 'min:1'],
            'last_name_en' => ['required', 'max:50', 'min:3'],
            'student_status_code' => ['required', 'exists:student_status,code'],
            'level' => ['required', Rule::in([1, 2, 3, 4, 5, 6, 7, 8])],
            'year' => ['required', Rule::in([Date::getCurrentYear()])],
            'transfer' => ['required', Rule::in(Transfer::getKeys())],
            'advisor_id' => ['required', 'exists:users,id']
        ]);

        $year = substr((string) ((int) Date::getCurrentYear() + 543), -2);
        $first_name_en = strtolower($request->first_name_en);
        $last_name_en = strtolower($request->last_name_en);
        $short_name = $first_name_en.'.'.substr($last_name_en, 0, 3);
        $rmutto_email = User::where('rmutto_email', '=', $short_name.'@rmutto.ac.th')
                            ->count() ? $first_name_en.'.'.$last_name_en : $short_name;
        $number = User::selectRaw('SUBSTRING(username, 10, 3) as number')
                    ->whereRaw('SUBSTRING(username, 3, 2) = ?', [$year])
                    ->orderByRaw('username DESC')
                    ->first()
                    ->number ?? '000';

        if (User::where('rmutto_email', '=', $rmutto_email.'@rmutto.ac.th')->count()) {
            throw ValidationException::withMessages([
                'first_name_en' => ['The first name en has already been taken.'],
                'last_name_en' => ['The last name en has already been taken.']
            ]);
        }
        
        // User.
        $user = new User();
        $user->username = '01'.$year.'40664'.sprintf('%03d', ((int) $number + 1)).'-'.rand(0, 9);
        $user->password = Hash::make($short_name);
        $user->first_name_th = $request->first_name_th;
        $user->last_name_th = $request->last_name_th;
        $user->prefix = $request->prefix;
        $user->first_name_en = ucfirst($first_name_en);
        $user->last_name_en = ucfirst($last_name_en);
        $user->rmutto_email = $rmutto_email.'@rmutto.ac.th';
        $user->role = Role::STUDENT;
        $user->status = Status::ENABLE;
        $user->save();

        // Student.
        $student = new StudentInformation();
        $student->user_id = $user->id;
        $student->advisor_id = $request->advisor_id;
        $student->student_status_code = $request->student_status_code;
        $student->level = $request->level;
        $student->year = $request->year;
        $student->transfer = $request->transfer;
        $student->save();

        // Personal.
        $personal = new PersonalInformation();
        $personal->user_id = $user->id;
        $personal->scholarship = Scholarship::NO;
        $personal->save();

        // Family.
        $family = new FamilyInformation();
        $family->user_id = $user->id;
        $family->save();

        // Education.
        $education = new EducationInformation();
        $education->user_id = $user->id;
        $education->save();

        return redirect()->route('student_management.index');
    }

    public function edit($id): View|RedirectResponse
    {
        $user = User::where('id', '=', $id)
            ->where('role', '=', Role::STUDENT)
            ->where('status', '=', Status::ENABLE)
            ->first();
        if (!$user) return redirect()->route('student_management.index');
        $info = $this->getInfo($user);

        // Student.
        $current_year = Date::getCurrentYear();
        $prefix = Prefix::getKeys();
        $transfer = Transfer::getKeys();
        $student_status = StudentStatus::orderBy('title', 'asc')->get();
        $advisors = User::selectRaw('id, first_name_th, last_name_th')
            ->where('role', '=', Role::TEACHER)
            ->where('status', '=', Status::ENABLE)
            ->orderByRaw('first_name_th asc, last_name_th asc')
            ->get();

        // Personal.
        $current_date = Date::getCurrentDateTH();
        $scholarship = Scholarship::getKeys();
        $blood_type = BloodType::getKeys();
        $religion = Religion::getKeys();
        $shirt_size = ShirtSize::getKeys();
        $countries = Country::orderBy('title', 'asc')->get();

        // Family.
        $family_status = FamilyStatus::orderBy('id', 'asc')->get();
        $careers = Career::orderBy('id', 'asc')->get();
        $relationship = Relationship::orderBy('id', 'asc')->get();
        $life = Life::getKeys();
        $income = Income::getKeys();

        // Education.
        $education = Education::getKeys();

        return view(
            'cruds.student_management.edit',
            compact(
                'id',
                'info',
                'current_year',
                'prefix',
                'transfer',
                'student_status',
                'advisors',
                'current_date',
                'scholarship',
                'blood_type',
                'religion',
                'shirt_size',
                'countries',
                'family_status',
                'careers',
                'relationship',
                'life',
                'income',
                'education'
            )
        );
    }

    public function update(Request $request, $id): Response|RedirectResponse
    {
        $current_year = Date::getCurrentYear();
        $validator = Validator::make($request->all(), [
            'prefix' => ['required', Rule::in(Prefix::getKeys())],
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50', 'min:1'],
            'last_name_en' => ['required', 'max:50', 'min:3'],
            'student_status_code' => ['required', 'exists:student_status,code'],
            'level' => ['required', Rule::in([1, 2, 3, 4, 5, 6, 7, 8])],
            'year' => ['required', 'integer', 'between:' . ($current_year - 9) . ',' . $current_year],
            'transfer' => ['required', Rule::in(Transfer::getKeys())],
            'advisor_id' => ['required', 'exists:users,id'],

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
            'address' => ['nullable'],

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
            'relative_address' => ['nullable'],

            'education' => ['nullable', Rule::in(Education::getKeys())],
            'name_school' => ['nullable'],
            'qualification' => ['nullable'],
            'graduate_year' => ['nullable', 'integer', 'between:' . ($current_year - 9) . ',' . $current_year],
            'gpa' => ['nullable', 'numeric', 'between:0,4']
        ]);
        
        if ($validator->fails()) {
            $redirect_url = redirect()->back()->withErrors($validator)->withInput();
            
            $field_groups = [
                'student_information' => [
                    'prefix',
                    'first_name_th',
                    'last_name_th',
                    'first_name_en',
                    'last_name_en',
                    'student_status_code',
                    'level',
                    'year',
                    'transfer',
                    'advisor_id'
                ],
                'personal_information' => [
                    'birth_date',
                    'weight',
                    'height',
                    'email',
                    'tel',
                    'scholarship',
                    'disability',
                    'blood_type',
                    'nationality',
                    'ethnicity',
                    'religion',
                    'shirt_size',
                    'interest',
                    'address'
                ],
                'family_information' => [
                    'family_status_id',
                    'father_first_name_th',
                    'father_last_name_th',
                    'father_first_name_en',
                    'father_last_name_en',
                    'father_life',
                    'father_income',
                    'father_career_id',
                    'mother_first_name_th',
                    'mother_last_name_th',
                    'mother_first_name_en',
                    'mother_last_name_en',
                    'mother_life',
                    'mother_income',
                    'mother_career_id',
                    'relative_first_name_th',
                    'relative_last_name_th',
                    'relative_first_name_en',
                    'relative_last_name_en',
                    'relationship_id',
                    'relative_life',
                    'relative_income',
                    'relative_career_id',
                    'relative_address'
                ],
                'education_information' => [
                    'education',
                    'name_school',
                    'qualification',
                    'graduate_year',
                    'gpa'
                ]
            ];
        
            foreach ($field_groups as $group => $fields) {
                foreach ($fields as $field) {
                    if ($validator->errors()->has($field)) {
                        return $redirect_url->header('Location', url()->previous() . '#' . $group);
                    }
                }
            }

            return $redirect_url;
        }

        $user = User::where('id', '=', $id)->first();
        $first_name_en = strtolower($request->first_name_en);
        $last_name_en = strtolower($request->last_name_en);
        $birth_date = explode('-', $request->birth_date);
        $rmutto_email = $user->rmutto_email;

        $rmutto_email_tmp_1 = $first_name_en.'.'.substr($last_name_en, 0, 3).'@rmutto.ac.th';
        $rmutto_email_tmp_2 = $first_name_en.'.'.$last_name_en.'@rmutto.ac.th';
        
        if ($rmutto_email != $rmutto_email_tmp_1 && $rmutto_email != $rmutto_email_tmp_2) {
            $rmutto_email = User::where('rmutto_email', '=', $rmutto_email_tmp_1)
                                ->count() ? $rmutto_email_tmp_2 : $rmutto_email_tmp_1;

            if (User::where('rmutto_email', '=', $rmutto_email)->count()) {
                throw ValidationException::withMessages([
                    'first_name_en' => ['The first name en has already been taken.'],
                    'last_name_en' => ['The last name en has already been taken.']
                ]);
            }
        }

        $input = $request->all();
        $input['first_name_en'] = ucfirst($first_name_en);
        $input['last_name_en'] = ucfirst($last_name_en);
        $input['rmutto_email'] = $rmutto_email;
        $input['birth_date'] = sprintf('%04d-%02d-%02d', $birth_date[2] - 543, $birth_date[1], $birth_date[0]);
        $input['father_first_name_en'] = isset($request->father_first_name_en) ? ucfirst(strtolower($request->father_first_name_en)) : null;
        $input['father_last_name_en'] = isset($request->father_last_name_en) ? ucfirst(strtolower($request->father_last_name_en)) : null;
        $input['mother_first_name_en'] = isset($request->mother_first_name_en) ? ucfirst(strtolower($request->mother_first_name_en)) : null;
        $input['mother_last_name_en'] = isset($request->mother_last_name_en) ? ucfirst(strtolower($request->mother_last_name_en)) : null;
        $input['relative_first_name_en'] = isset($request->relative_first_name_en) ? ucfirst(strtolower($request->relative_first_name_en)) : null;
        $input['relative_last_name_en'] = isset($request->relative_last_name_en) ? ucfirst(strtolower($request->relative_last_name_en)) : null;
        $request->merge($input);

        // User.
        $user->update($request->all());

        // Student.
        $student_information = StudentInformation::where('user_id', '=', $id)->first();
        $student_information->update($request->all());

        // Personal.
        $personal_information = PersonalInformation::where('user_id', '=', $id)->first();
        $personal_information->update($request->all());

        // Family.
        $family_information = FamilyInformation::where('user_id', '=', $id)->first();
        $family_information->update($request->all());

        // Education.
        $education_information = EducationInformation::where('user_id', '=', $id)->first();
        $education_information->update($request->all());
        
        return redirect()->route('student_management.index');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $input = array_filter($request->all(), function($key) {
            return in_array($key, ['page', 'search', 'per_page', 'sort_by', 'sort_direction']);
        }, ARRAY_FILTER_USE_KEY);

        $user = User::where('id', '=', $id)->first();
        $user->status = Status::DISABLE;
        $user->save();

        return redirect()->route('student_management.index', $input);
    }

    private function getInfo(User $user): \stdClass
    {
        $student = $user->student_information;
        $personal = $user->personal_information;
        $family = $user->family_information;
        $education = $user->education_information;

        $birth_datetime = new DateTime($personal->birth_date);
        $thai_year = (int) $birth_datetime->format('Y') + 543;

        // Student.
        $info = new \stdClass();
        $info->student_id = $user->username;
        $info->prefix = $user->prefix;
        $info->first_name_th = $user->first_name_th;
        $info->last_name_th = $user->last_name_th;
        $info->first_name_en = $user->first_name_en;
        $info->last_name_en = $user->last_name_en;
        $info->rmutto_email = $user->rmutto_email;
        $info->student_status = $student->student_status;
        $info->level = $student->level;
        $info->year = $student->year;
        $info->transfer = $student->transfer;
        $info->advisor = $student->advisor;

        // Personal.
        $info->birth_date = $birth_datetime->format('d-m-').$thai_year;
        $info->weight = $personal->weight;
        $info->height = $personal->height;
        $info->email = $personal->email;
        $info->tel = $user->tel;
        $info->scholarship = $personal->scholarship;
        $info->disability = $personal->disability;
        $info->blood_type = $personal->blood_type;
        $info->nationality = $personal->nationality_info;
        $info->ethnicity = $personal->ethnicity_info;
        $info->religion = $personal->religion;
        $info->shirt_size = $personal->shirt_size;
        $info->interest = $personal->interest;
        $info->address = $personal->address;

        // Family.
        $info->family_status = $family->family_status;
        $info->father_first_name_th = $family->father_first_name_th;
        $info->father_last_name_th = $family->father_last_name_th;
        $info->father_first_name_en = $family->father_first_name_en;
        $info->father_last_name_en = $family->father_last_name_en;
        $info->father_life = $family->father_life;
        $info->father_income = $family->father_income;
        $info->father_career = $family->father_career;
        $info->mother_first_name_th = $family->mother_first_name_th;
        $info->mother_last_name_th = $family->mother_last_name_th;
        $info->mother_first_name_en = $family->mother_first_name_en;
        $info->mother_last_name_en = $family->mother_last_name_en;
        $info->mother_life = $family->mother_life;
        $info->mother_income = $family->mother_income;
        $info->mother_career = $family->mother_career;
        $info->relative_first_name_th = $family->relative_first_name_th;
        $info->relative_last_name_th = $family->relative_last_name_th;
        $info->relative_first_name_en = $family->relative_first_name_en;
        $info->relative_last_name_en = $family->relative_last_name_en;
        $info->relationship = $family->relationship;
        $info->relative_life = $family->relative_life;
        $info->relative_address = $family->relative_address;
        $info->relative_income = $family->relative_income;
        $info->relative_career = $family->relative_career;

        // Education.
        $info->education = $education->education;
        $info->name_school = $education->name_school;
        $info->qualification = $education->qualification;
        $info->graduate_year = $education->graduate_year;
        $info->gpa = $education->gpa;

        return $info;
    }
}

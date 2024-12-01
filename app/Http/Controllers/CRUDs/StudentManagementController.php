<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
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

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'prefix' => ['required', Rule::in(Prefix::getKeys())],
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50'],
            'last_name_en' => ['required', 'max:50'],
            'student_status_code' => ['required', 'exists:student_status,code'],
            'level' => ['required', Rule::in([1, 2, 3, 4, 5, 6, 7, 8])],
            'year' => ['required', Rule::in([Date::getCurrentYear()])],
            'transfer' => ['required', Rule::in(Transfer::getKeys())],
            'advisor_id' => ['required', 'exists:users,id'],
        ]);

        $year = substr((string) ((int) Date::getCurrentYear() + 543), -2);
        $first_name_en = strtolower(trim($request->first_name_en));
        $last_name_en = strtolower(trim($request->last_name_en));
        $short_name = $first_name_en.'.'.substr($last_name_en, 0, 3);
        $number = User::selectRaw('SUBSTRING(username, 10, 3) as number')
                        ->whereRaw('SUBSTRING(username, 3, 2) = ?', [$year])
                        ->orderByRaw('username DESC')
                        ->first()
                        ->number ?? '000';

        // User.
        $user = new User();
        $user->username = '01'.$year.'40664'.sprintf('%03d', ((int) $number + 1)).'-'.rand(0, 9);
        $user->password = Hash::make($short_name);
        $user->first_name_th = trim($request->first_name_th);
        $user->last_name_th = trim($request->last_name_th);
        $user->prefix = $request->prefix;
        $user->first_name_en = ucfirst($first_name_en);
        $user->last_name_en = ucfirst($last_name_en);
        $user->rmutto_email = $short_name.'@rmutto.ac.th';
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

    public function edit($id): View
    {
        // Student.

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
        $current_year = Date::getCurrentYear();
        $education = Education::getKeys();

        return view(
            'cruds.student_management.edit',
            compact(
                'education',
                'current_year',
                'family_status',
                'careers',
                'relationship',
                'life',
                'income',
                'current_date',
                'scholarship',
                'blood_type',
                'religion',
                'shirt_size',
                'countries'
            )
        );
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // TODO.

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
}

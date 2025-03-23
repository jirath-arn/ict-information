<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Exception;
use Excel;
use App\Enums\Prefix;
use App\Enums\Status;
use App\Enums\Role;
use App\Models\User;
use App\Imports\TeacherImport;

class TeacherManagementController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        $search = $request->input('search', '');
        $per_page = $request->input('per_page', 5);
        $sort_by = $request->input('sort_by', 'employee_id');
        $sort_direction = $request->input('sort_direction', 'asc');

        if (!in_array($per_page, [5, 10, 15, 20]) ||
            !in_array($sort_by, ['full_name_th', 'rmutto_email', 'employee_id', 'full_name_en']) ||
            !in_array($sort_direction, ['asc', 'desc'])) {
            return redirect()->route('teacher_management.index');
        }

        switch ($sort_by) {
            case "full_name_th":
                $sort_by = "users.first_name_th $sort_direction, users.last_name_th asc";
                break;
            case "rmutto_email":
                $sort_by = "users.rmutto_email $sort_direction";
                break;
            case "employee_id":
                $sort_by = "users.username $sort_direction";
                break;
            case "full_name_en":
                $sort_by = "users.first_name_en $sort_direction, users.last_name_en asc";
                break;
        }

        $teachers = User::where('users.status', '=', Status::ENABLE)
            ->where('users.role', '=', Role::TEACHER)
            ->when($search, function ($query) use ($search) {
                return $query->where('users.first_name_th', 'like', '%'.$search.'%')
                    ->orWhere('users.last_name_th', 'like', '%'.$search.'%')
                    ->orWhere('users.first_name_en', 'like', '%'.$search.'%')
                    ->orWhere('users.last_name_en', 'like', '%'.$search.'%')
                    ->orWhere('users.username', 'like', '%'.$search.'%')
                    ->orWhere('users.rmutto_email', 'like', '%'.$search.'%')
                    ->orWhere('users.tel', 'like', '%'.$search.'%');
            })
            ->orderByRaw($sort_by)
            ->paginate($per_page);

        return view('cruds.teacher_management.index', compact('teachers'));
    }

    public function create(): View
    {
        $prefix = Prefix::getKeys();

        return view('cruds.teacher_management.create', compact('prefix'));
    }

    public function importExcel(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new TeacherImport, $request->file('excel_file'));
            return redirect()->route('teacher_management.index');

        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'excel' => ['นำเข้า Excel ไม่สำเร็จ! กรุณาตรวจสอบข้อมูลให้ถูกต้อง']
            ]);
        }
    }

    public function store(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'prefix' => ['required', Rule::in(Prefix::getKeys())],
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50', 'min:1'],
            'last_name_en' => ['required', 'max:50', 'min:3'],
            'tel' => ['nullable', 'max:10']
        ]);
        
        $first_name_en = strtolower($request->first_name_en);
        $last_name_en = strtolower($request->last_name_en);
        $short_name = $first_name_en.'.'.substr($last_name_en, 0, 3);
        $rmutto_email = User::where('rmutto_email', '=', $short_name.'@rmutto.ac.th')
                            ->count() ? $first_name_en.'.'.$last_name_en : $short_name;
        $number = User::selectRaw('username as number')
                    ->whereRaw('role = ?', [Role::TEACHER])
                    ->orderByRaw('username DESC')
                    ->first()
                    ->number ?? '000000000';

        if (User::where('rmutto_email', '=', $rmutto_email.'@rmutto.ac.th')->count()) {
            throw ValidationException::withMessages([
                'first_name_en' => ['The first name en has already been taken.'],
                'last_name_en' => ['The last name en has already been taken.']
            ]);
        }
        
        $user = new User();
        $user->username = sprintf('%09d', ((int) $number + 1));
        $user->password = Hash::make($short_name);
        $user->first_name_th = $request->first_name_th;
        $user->last_name_th = $request->last_name_th;
        $user->prefix = $request->prefix;
        $user->first_name_en = ucfirst($first_name_en);
        $user->last_name_en = ucfirst($last_name_en);
        $user->rmutto_email = $rmutto_email.'@rmutto.ac.th';
        $user->tel = $request->tel;
        $user->role = Role::TEACHER;
        $user->status = Status::ENABLE;
        $user->save();

        return redirect()->route('teacher_management.index');
    }

    public function edit($id): View|RedirectResponse
    {
        $user = User::where('id', '=', $id)
            ->where('role', '=', Role::TEACHER)
            ->where('status', '=', Status::ENABLE)
            ->first();
        if (!$user) return redirect()->route('teacher_management.index');

        $prefix = Prefix::getKeys();
        $info = new \stdClass;
        $info->employee_id = $user->username;
        $info->prefix = $user->prefix;
        $info->first_name_th = $user->first_name_th;
        $info->last_name_th = $user->last_name_th;
        $info->first_name_en = $user->first_name_en;
        $info->last_name_en = $user->last_name_en;
        $info->rmutto_email = $user->rmutto_email;
        $info->tel = $user->tel;

        return view('cruds.teacher_management.edit', compact('id', 'info', 'prefix'));
    }

    public function update(Request $request, $id): Response|RedirectResponse
    {
        $request->validate([
            'prefix' => ['required', Rule::in(Prefix::getKeys())],
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50', 'min:1'],
            'last_name_en' => ['required', 'max:50', 'min:3'],
            'tel' => ['nullable', 'max:10']
        ]);

        $user = User::where('id', '=', $id)->first();
        $first_name_en = strtolower($request->first_name_en);
        $last_name_en = strtolower($request->last_name_en);
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
        $request->merge($input);

        $user->update($request->all());

        return redirect()->route('teacher_management.index');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        $input = array_filter($request->all(), function($key) {
            return in_array($key, ['page', 'search', 'per_page', 'sort_by', 'sort_direction']);
        }, ARRAY_FILTER_USE_KEY);

        $user = User::where('id', '=', $id)->first();
        $user->status = Status::DISABLE;
        $user->save();

        return redirect()->route('teacher_management.index', $input);
    }
}

<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Enums\Status;
use App\Enums\Role;
use App\Helpers\Auth;
use App\Models\StudentInformation;
use App\Models\User;

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

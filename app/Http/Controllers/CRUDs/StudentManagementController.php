<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Enums\Status;
use App\Models\StudentInformation;

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
                $sort_by = "first_name_th $sort_direction, last_name_th asc";
                break;
            case "level":
                $sort_by = "level $sort_direction, first_name_th asc, last_name_th asc";
                break;
            case "student_id":
                $sort_by = "username $sort_direction";
                break;
            case "full_name_en":
                $sort_by = "first_name_en $sort_direction, last_name_en asc";
                break;
        }

        $students = StudentInformation::leftJoin('users', 'student_information.user_id', '=', 'users.id')
            ->where('status', '=', Status::ENABLE)
            ->when($search, function ($query) use ($search) {
                return $query->where('first_name_th', 'like', '%'.$search.'%')
                            ->orWhere('last_name_th', 'like', '%'.$search.'%')
                            ->orWhere('first_name_en', 'like', '%'.$search.'%')
                            ->orWhere('last_name_en', 'like', '%'.$search.'%')
                            ->orWhere('username', 'like', '%'.$search.'%');
            })
            ->orderByRaw($sort_by)
            ->paginate($per_page);

        return view('cruds.student_management.index', compact('students'));
    }
}

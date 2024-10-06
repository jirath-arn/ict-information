<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Enums\Role;
use App\Models\User;

class StudentManagementController extends Controller
{
    public function index(): View
    {
        $students = User::where('role', '=', Role::STUDENT)->get();

        return view('cruds.student_management.index', compact('students'));
    }
}

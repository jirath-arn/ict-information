<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\Role;
use App\Models\User;

class StudentManagementController extends Controller
{
    public function index()
    {
        $students = User::where('role', Role::STUDENT)->get();
        
        return view('cruds.student_management.index', compact('students'));
    }
}

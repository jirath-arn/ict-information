<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TeacherManagementController extends Controller
{
    public function index(): View
    {
        return view('cruds.teacher_management.index');
    }
}

<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentManagementController extends Controller
{
    public function index()
    {
        return view('cruds.student_management.index');
    }
}

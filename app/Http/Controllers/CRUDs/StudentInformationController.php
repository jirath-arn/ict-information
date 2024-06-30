<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    public function index()
    {
        return view('cruds.student_information.index');
    }
}

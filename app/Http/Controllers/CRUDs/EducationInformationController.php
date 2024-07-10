<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationInformationController extends Controller
{
    public function index()
    {
        return view('cruds.education_information.index');
    }
}

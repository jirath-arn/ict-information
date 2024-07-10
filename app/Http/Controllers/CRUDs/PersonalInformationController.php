<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function index()
    {
        return view('cruds.personal_information.index');
    }
}

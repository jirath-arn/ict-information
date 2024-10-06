<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PersonalInformationController extends Controller
{
    public function index(): View
    {
        return view('cruds.personal_information.index');
    }
}

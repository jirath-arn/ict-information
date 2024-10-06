<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class FamilyInformationController extends Controller
{
    public function index(): View
    {
        return view('cruds.family_information.index');
    }
}

<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FamilyInformationController extends Controller
{
    public function index()
    {
        return view('cruds.family_information.index');
    }
}

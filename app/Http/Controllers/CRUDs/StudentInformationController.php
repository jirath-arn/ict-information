<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Auth;

class StudentInformationController extends Controller
{
    public function index()
    {
        $info = new \stdClass();
        $info->student_id = Auth::getUsername();
        $info->full_name_th = Auth::getFullNameTH();
        $info->full_name_en = Auth::getFullNameEN();
        $info->rmutto_email = Auth::getRmuttoEmail();
        
        return view('cruds.student_information.index', compact('info'));
    }
}

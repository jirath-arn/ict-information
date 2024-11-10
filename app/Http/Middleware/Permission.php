<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;
use App\Helpers\Auth;

class Permission
{
    public function handle(Request $request, Closure $next): Response
    {
        $student = array(
            'student_information',
            'personal_information',
            'family_information',
            'education_information'
        );
        $teacher = array(
            'dashboard',
            'student_management'
        );
        $admin = array(
            'dashboard',
            'student_management',
            'teacher_management'
        );

        $path = explode('/', $request->path());
        $role = Auth::getRoleEN();

//        if ($role == Role::STUDENT) {
//            return redirect()->route('student_information.index');
//
//        } else if ($role == Role::ADMIN) {
//            return redirect()->route('dashboard.index');
//        }

        return $next($request);
    }
}

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

        $paths = explode('/', $request->path());
        $path_first = $paths[0];
        $path_end = end($paths);
        $role = Auth::getRoleEN();

        if ($role == Role::STUDENT && !in_array($path_first, $student)) {
            return redirect()->route('student_information.index');

        } elseif ($role == Role::TEACHER && !in_array($path_first, $teacher)) {
            return redirect()->route('dashboard.index');

        } elseif ($role == Role::TEACHER && $path_first == 'student_management' && $path_end != 'student_management') {
            return redirect()->route('dashboard.index');

        } elseif ($role == Role::ADMIN && !in_array($path_first, $admin)) {
            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}

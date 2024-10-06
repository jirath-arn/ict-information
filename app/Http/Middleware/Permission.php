<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;
use App\Helpers\Auth;

class TeacherRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::getRoleEN();

        if ($role === Role::STUDENT) {
            return redirect()->route('student_information.index');

        } else if ($role === Role::ADMIN) {
            return redirect()->route('dashboard.index');
        }

        return $next($request);
    }
}

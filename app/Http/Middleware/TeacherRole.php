<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;

class TeacherRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = auth()->user()->role->value;

        if ($role === Role::STUDENT) {
            return redirect()->route('student_information');

        } else if ($role === Role::ADMIN) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

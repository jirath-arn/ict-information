<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;
use App\Helpers\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::getRole();

        if ($role === Role::STUDENT) {
            return redirect()->route('student_information');

        } else if ($role === Role::TEACHER) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

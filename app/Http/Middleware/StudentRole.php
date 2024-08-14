<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\Role;
use App\Helpers\Auth;

class StudentRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $role = Auth::getRole();

        if ($role === Role::TEACHER) {
            return redirect()->route('dashboard');

        } else if ($role === Role::ADMIN) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}

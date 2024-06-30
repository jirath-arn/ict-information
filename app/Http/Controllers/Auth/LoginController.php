<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function redirectTo()
    {
        $role = auth()->user()->role->value;

        if ($role === Role::STUDENT) {
            return '/student_information';

        } else if ($role === Role::TEACHER) {
            return '/dashboard';

        } else if ($role === Role::ADMIN) {
            return '/dashboard';

        } else {
            return '/';
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

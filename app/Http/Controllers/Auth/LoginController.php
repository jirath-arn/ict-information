<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function username()
    {
        return 'username';
    }

    protected function form()
    {
        return 'form';
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

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->form() => ['ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|max:20',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

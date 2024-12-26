<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Enums\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function username(): string
    {
        return 'username';
    }

    protected function form(): string
    {
        return 'form';
    }

    protected function redirectTo(): string
    {
        $role = auth()->user()->role->value;

        if ($role == Role::STUDENT) {
            return '/student_information';

        } elseif ($role == Role::TEACHER) {
            return '/dashboard';

        } elseif ($role == Role::ADMIN) {
            return '/dashboard';

        } else {
            return '/';
        }
    }

    protected function sendFailedLoginResponse(Request $request): Response
    {
        throw ValidationException::withMessages([
            $this->form() => ['ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง']
        ]);
    }

    protected function validateLogin(Request $request): void
    {
        $request->validate([
            $this->username() => 'required|string|max:14',
            'password' => 'required|string'
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

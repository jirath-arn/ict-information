<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Helpers\Auth;
use App\Helpers\Tel;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = User::where('users.id', '=', Auth::getId())->first();

        $info = new \stdClass();
        $info->username = $user->username;
        $info->full_name_with_prefix_th = Auth::getFullNameWithPrefixTH();
        $info->full_name_with_prefix_en = Auth::getFullNameWithPrefixEN();
        $info->rmutto_email = $user->rmutto_email;
        $info->tel = Tel::format($user->tel);

        return view('cruds.profile.index', compact('info'));
    }

    public function password(): View
    {
        return view('cruds.profile.password');
    }

    public function update(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'min:8', 'same:new_password']
        ]);

        $user = User::where('users.id', '=', Auth::getId())->first();

        if (!Hash::check($request->old_password, $user->password)) {
            throw ValidationException::withMessages([
                'old_password' => ['รหัสผ่านไม่ถูกต้อง']
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile.index');
    }
}

<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Enums\Role;
use App\Helpers\Auth;
use App\Helpers\Tel;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(): View
    {
        $user = User::where('id', '=', Auth::getId())->first();
        $full_name_with_prefix_th = Auth::getFullNameWithPrefixTH();
        $full_name_with_prefix_en = Auth::getFullNameWithPrefixEN();

        if (Auth::getRoleEN() == Role::ADMIN) {
            $th = explode(' ', $full_name_with_prefix_th);
            $en = explode(' ', $full_name_with_prefix_en);

            $full_name_with_prefix_th = implode(' ', array_slice($th, 1));
            $full_name_with_prefix_en = implode(' ', array_slice($en, 1));
        }

        $info = new \stdClass();
        $info->username = $user->username;
        $info->full_name_with_prefix_th = $full_name_with_prefix_th;
        $info->full_name_with_prefix_en = $full_name_with_prefix_en;
        $info->rmutto_email = $user->rmutto_email;
        $info->tel = Tel::format($user->tel);

        return view('cruds.profile.index', compact('info'));
    }

    public function edit(): View
    {
        $user = User::where('id', '=', Auth::getId())->first();

        $info = new \stdClass();
        $info->admin_id = $user->username;
        $info->first_name_th = $user->first_name_th;
        $info->last_name_th = $user->last_name_th;
        $info->first_name_en = $user->first_name_en;
        $info->last_name_en = $user->last_name_en;
        $info->rmutto_email = $user->rmutto_email;
        $info->tel = $user->tel;

        return view('cruds.profile.edit', compact('info'));
    }

    public function update(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'first_name_th' => ['required', 'max:50'],
            'last_name_th' => ['required', 'max:50'],
            'first_name_en' => ['required', 'max:50'],
            'last_name_en' => ['required', 'max:50'],
            'rmutto_email' => ['required', 'email:rfc,dns', 'max:70'],
            'tel' => ['nullable', 'max:10']
        ]);

        $user = User::where('id', '=', Auth::getId())->first();

        if ($user->rmutto_email != $request->rmutto_email &&
            User::where('rmutto_email', '=', $request->rmutto_email)->count()) {
                throw ValidationException::withMessages([
                    'rmutto_email' => ['The rmutto email has already been taken.']
                ]);
        }

        $input = $request->all();
        $input['first_name_en'] = ucfirst(strtolower($request->first_name_en));
        $input['last_name_en'] = ucfirst(strtolower($request->last_name_en));
        $request->merge($input);
        
        $user->update($request->all());

        return redirect()->route('profile.index');
    }

    public function password(): View
    {
        return view('cruds.profile.password.index');
    }

    public function password_update(Request $request): Response|RedirectResponse
    {
        $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required', 'string', 'min:8', 'same:new_password']
        ]);

        $user = User::where('id', '=', Auth::getId())->first();

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

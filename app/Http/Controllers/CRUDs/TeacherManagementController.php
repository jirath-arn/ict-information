<?php

namespace App\Http\Controllers\CRUDs;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class TeacherManagementController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        // TODO.

        return view('cruds.teacher_management.index');
    }

    public function create(): View
    {
        // TODO.

        return view('cruds.teacher_management.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // TODO.

        return redirect()->route('teacher_management.index');
    }

    public function edit($id): View
    {
        // TODO.

        return view('cruds.teacher_management.edit');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // TODO.

        return redirect()->route('teacher_management.index');
    }

    public function destroy(Request $request, $id): RedirectResponse
    {
        // TODO.

        return redirect()->route('teacher_management.index');
    }
}

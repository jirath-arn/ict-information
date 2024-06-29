@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<main class="container flex items-center justify-center py-10">
    <div class="w-full md:w-1/2 xl:w-1/3">
        <div class="mx-5 md:mx-10">
            <h2 class="uppercase">ICT-Information</h2>
            <h4 class="uppercase">Rmutto</h4>
        </div>

        <form action="#" class="card mt-5 p-5 md:p-10">
            {{-- Username --}}
            <div class="mb-5">
                <label for="username" class="label block mb-2">
                    Username
                </label>

                <input id="username" type="text" class="form-control" placeholder="XXXXXXXXXXXX-X" required />
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="label block mb-2">
                    Password
                </label>

                <input id="password" type="password" class="form-control" required />
            </div>

            {{-- Login Button --}}
            <div class="flex items-center">
                <button class="btn btn_primary mx-auto uppercase">
                    Login
                </button>
            </div>
        </form>
    </div>
</main>
@endsection

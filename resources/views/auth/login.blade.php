@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<main class="container flex items-center justify-center py-10">
    <div class="w-full md:w-1/2 xl:w-1/3">
        <div class="mx-5 md:mx-10">
            <h2 class="uppercase">ICT-Information</h2>
            <h4 class="uppercase">Rmutto</h4>
        </div>

        <form action="{{ route('login') }}" method="POST" id="loginForm" class="card mt-5 p-5 md:p-10">
            @csrf
            
            {{-- Username --}}
            <div class="mb-5">
                <label for="username" class="label block mb-2">
                    Username
                </label>

                <input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', null) }}" maxlength="20" placeholder="XXXXXXXXXXXX-X" autocomplete="username" required autofocus />
                @error('username')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="label block mb-2">
                    Password
                </label>

                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password" required />
                @error('password')
                    <small class="block mt-2 invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            {{-- Login Button --}}
            <div class="flex items-center">
                <button id="loginButton" type="submit" class="btn btn_primary mx-auto uppercase">
                    Login
                </button>
            </div>

            {{-- Error --}}
            @error('form')
                <div class="flex items-center mt-5">
                    <small class="block invalid-feedback mx-auto">
                        {{ $message }}
                    </small>
                </div>
            @enderror
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>
    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginButton');
        btn.setAttribute('disabled', true);
        btn.innerText = 'Login...';
    });
</script>
@endsection

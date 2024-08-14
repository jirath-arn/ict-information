@extends('layouts.auth')

@section('title', 'เข้าสู่ระบบ')

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
                    ชื่อผู้ใช้
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
                    รหัสผ่าน
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
                    เข้าสู่ระบบ
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
<script type="module">
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            $('#loginButton').prop('disabled', true);
            $('#loginButton').text('เข้าสู่ระบบ...');
        });
    });
</script>
@endsection

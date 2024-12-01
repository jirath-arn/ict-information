@extends('layouts.app')

@section('title', 'รหัสผ่าน')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>รหัสผ่าน</h1>
        <ul>
            <li>
                <a href="{{ route('profile.index') }}">โปรไฟล์</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>รหัสผ่าน</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('profile.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="updateForm" action="{{ route('profile.password_update') }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @csrf

            <table class="table table_borderless w-full">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-right font-bold">
                            <label for="old_password">รหัสผ่านเดิม</label>
                        </td>
                        <td class="w-3/4 text-left">
                            <input id="old_password" name="old_password" type="password" minlength="8" class="form-control @error('old_password') is-invalid @enderror" required />
                            @error('old_password')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="new_password">รหัสผ่านใหม่</label>
                        </td>
                        <td class="text-left">
                            <input id="new_password" name="new_password" type="password" minlength="8" class="form-control @error('new_password') is-invalid @enderror" required />
                            @error('new_password')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="new_password_confirmation">ยืนยันรหัสผ่านใหม่</label>
                        </td>
                        <td class="text-left">
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password" minlength="8" class="form-control @error('new_password_confirmation') is-invalid @enderror" required />
                            @error('new_password_confirmation')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#updateButton').click(function(e) {
                $('#updateForm').submit();
            });
        });
    </script>
@endsection

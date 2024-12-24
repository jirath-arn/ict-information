@extends('layouts.app')

@section('title', 'แก้ไขโปรไฟล์')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขโปรไฟล์</h1>
        <ul>
            <li>
                <a href="{{ route('profile.index') }}">โปรไฟล์</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>แก้ไขโปรไฟล์</li>
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
        <form id="updateForm" action="{{ route('profile.update') }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @csrf
            
            <table class="table table_borderless w-full">
                <tbody>
                    <tr>
                        <td class="w-1/4 text-right font-bold">
                            รหัสผู้ดูแลระบบ
                        </td>
                        <td class="w-3/4 text-left">
                            {{ $info->admin_id ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="first_name_th">ชื่อ</label>
                        </td>
                        <td class="text-left">
                            <input id="first_name_th" name="first_name_th" type="text" class="form-control @error('first_name_th') is-invalid @enderror" value="{{ old('first_name_th', $info->first_name_th ?? '') }}" maxlength="50" required autofocus />
                            @error('first_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="last_name_th">นามสกุล</label>
                        </td>
                        <td class="text-left">
                            <input id="last_name_th" name="last_name_th" type="text" class="form-control @error('last_name_th') is-invalid @enderror" value="{{ old('last_name_th', $info->last_name_th ?? '') }}" maxlength="50" required />
                            @error('last_name_th')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="first_name_en">First Name</label>
                        </td>
                        <td class="text-left">
                            <input id="first_name_en" name="first_name_en" type="text" class="form-control @error('first_name_en') is-invalid @enderror" value="{{ old('first_name_en', $info->first_name_en ?? '') }}" maxlength="50" required />
                            @error('first_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="last_name_en">Last Name</label>
                        </td>
                        <td class="text-left">
                            <input id="last_name_en" name="last_name_en" type="text" class="form-control @error('last_name_en') is-invalid @enderror" value="{{ old('last_name_en', $info->last_name_en ?? '') }}" maxlength="50" required />
                            @error('last_name_en')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="rmutto_email">อีเมล Rmutto</label>
                        </td>
                        <td class="text-left">
                            <input id="rmutto_email" name="rmutto_email" type="email" class="form-control @error('rmutto_email') is-invalid @enderror" value="{{ old('rmutto_email', $info->rmutto_email ?? '') }}" maxlength="70" required />
                            @error('rmutto_email')
                                <small class="block mt-2 invalid-feedback">
                                    {{ $message }}
                                </small>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right font-bold">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <p class="text-xs font-light mt-0.5">(ไม่จำเป็น)</p>
                        </td>
                        <td class="text-left">
                            <input id="tel" name="tel" type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel', $info->tel ?? '') }}" />
                            @error('tel')
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

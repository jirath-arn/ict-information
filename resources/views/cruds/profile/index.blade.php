@extends('layouts.app')

@section('title', 'โปรไฟล์')

@section('styles')
@php
    use App\Helpers\Auth;
    use App\Enums\Role;
@endphp
@endsection

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>โปรไฟล์</h1>
        <ul>
            <li>โปรไฟล์</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a href="{{ route('profile.password') }}" class="btn btn_primary uppercase">
            <span class="la la-edit text-xl leading-none mr-2"></span>
            เปลี่ยนรหัสผ่าน
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <table class="table table_borderless w-full">
            <tbody>
                <tr>
                    <td class="w-1/4 text-right font-bold">
                        @if(Auth::getRoleEN() == Role::STUDENT)
                            รหัสนักศึกษา
                        @else
                            รหัสพนักงาน
                        @endif
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->username ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ชื่อ - นามสกุล
                    </td>
                    <td class="text-left">
                        {{ $info->full_name_with_prefix_th ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        Full Name
                    </td>
                    <td class="text-left">
                        {{ $info->full_name_with_prefix_en ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อีเมล Rmutto
                    </td>
                    <td class="text-left">
                        {{ $info->rmutto_email ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        เบอร์โทรศัพท์ติดต่อ
                    </td>
                    <td class="text-left">
                        {{ $info->tel ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

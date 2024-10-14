@extends('layouts.app')

@section('title', 'ข้อมูลนักศึกษา')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>ข้อมูลนักศึกษา</h1>
        <ul>
            <li>ข้อมูลนักศึกษา</li>
        </ul>
    </section>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <table class="table table_borderless w-full">
            <tbody>
                <tr>
                    <td class="w-1/4 text-right font-bold">
                        รหัสนักศึกษา
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->student_id ?? '-' }}
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
                        สถานะนักศึกษา
                    </td>
                    <td class="text-left">
                        {{ $info->student_status->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ชั้นปีที่
                    </td>
                    <td class="text-left">
                        {{ $info->level ?? '-' }} / {{ $info->year ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อาจารย์ที่ปรึกษา
                    </td>
                    <td class="text-left">
                        {{ $info->advisor->full_name_with_prefix_th ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        เบอร์โทรศัพท์ติดต่อ
                    </td>
                    <td class="text-left">
                        {{ $info->advisor->tel ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อีเมล Rmutto
                    </td>
                    <td class="text-left">
                        {{ $info->advisor->rmutto_email ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

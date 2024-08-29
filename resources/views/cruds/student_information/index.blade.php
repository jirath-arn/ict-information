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

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a href="#" class="btn btn_primary uppercase">
            <span class="la la-edit text-xl leading-none mr-2"></span>
            แก้ไข
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <table class="table table_borderless w-full">
            <tbody>
                <tr>
                    <td class="w-1/4 text-right">
                        <strong>รหัสนักศึกษา</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->student_id }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ชื่อ - นามสกุล</strong>
                    </td>
                    <td class="text-left">
                        {{ $info->full_name_th }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>Full Name</strong>
                    </td>
                    <td class="text-left">
                        {{ $info->full_name_en }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>รหัสบัตรประชาชน</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>Rmutto Email</strong>
                    </td>
                    <td class="text-left">
                        {{ $info->rmutto_email }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>สถานะนักศึกษา</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ชั้นปีที่</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>อาจารย์ที่ปรึกษา</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>เบอร์โทรศัพท์ติดต่อ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>Rmutto Email</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

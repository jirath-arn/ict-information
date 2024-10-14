@extends('layouts.app')

@section('title', 'ประวัติครอบครัว')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>ประวัติครอบครัว</h1>
        <ul>
            <li>ประวัติครอบครัว</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a href="{{ route('family_information.edit') }}" class="btn btn_primary uppercase">
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
                    <td class="w-1/4 text-right font-bold">
                        สถานะครอบครัว
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->family_status->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ชื่อ - นามสกุล บิดา
                    </td>
                    <td class="text-left">
                        {{ $info->father_full_name_th ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        Full Name
                    </td>
                    <td class="text-left">
                        {{ $info->father_full_name_en ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สถานะ บิดา
                    </td>
                    <td class="text-left">
                        {{ $info->father_life ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        รายได้ บิดา
                    </td>
                    <td class="text-left">
                        {{ $info->father_income ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อาชีพ บิดา
                    </td>
                    <td class="text-left">
                        {{ $info->father_career->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ชื่อ - นามสกุล มารดา
                    </td>
                    <td class="text-left">
                        {{ $info->mother_full_name_th ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        Full Name
                    </td>
                    <td class="text-left">
                        {{ $info->mother_full_name_en ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สถานะ มารดา
                    </td>
                    <td class="text-left">
                        {{ $info->mother_life ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        รายได้ มารดา
                    </td>
                    <td class="text-left">
                        {{ $info->mother_income ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อาชีพ มารดา
                    </td>
                    <td class="text-left">
                        {{ $info->mother_career->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr />
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ชื่อ - นามสกุล ผู้ปกครอง
                    </td>
                    <td class="text-left">
                        {{ $info->relative_full_name_th ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        Full Name
                    </td>
                    <td class="text-left">
                        {{ $info->relative_full_name_en ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ความสัมพันธ์
                    </td>
                    <td class="text-left">
                        {{ $info->relationship->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สถานะ ผู้ปกครอง
                    </td>
                    <td class="text-left">
                        {{ $info->relative_life ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ที่อยู่
                    </td>
                    <td class="text-left">
                        {{ $info->address ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        รายได้ ผู้ปกครอง
                    </td>
                    <td class="text-left">
                        {{ $info->relative_income ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อาชีพ ผู้ปกครอง
                    </td>
                    <td class="text-left">
                        {{ $info->relative_career->title ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

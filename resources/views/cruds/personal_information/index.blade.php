@extends('layouts.app')

@section('title', 'ประวัติส่วนตัว')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>ประวัติส่วนตัว</h1>
        <ul>
            <li>ประวัติส่วนตัว</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a href="{{ route('personal_information.edit') }}" class="btn btn_primary uppercase">
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
                        วัน เดือน ปีเกิด
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->birth_date ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        น้ำหนัก / ส่วนสูง
                    </td>
                    <td class="text-left">
                        {{ $info->weight ?? '-' }} / {{ $info->height ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        อีเมล
                    </td>
                    <td class="text-left">
                        {{ $info->email ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        เบอร์โทรศัพท์มือถือ
                    </td>
                    <td class="text-left">
                        {{ $info->tel ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        การได้รับทุน
                    </td>
                    <td class="text-left">
                        {{ $info->scholarship ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ความพิการ
                    </td>
                    <td class="text-left">
                        {{ $info->disability ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        หมู่โลหิต
                    </td>
                    <td class="text-left">
                        {{ $info->blood_type ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สัญชาติ
                    </td>
                    <td class="text-left">
                        {{ $info->nationality->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        เชื้อชาติ
                    </td>
                    <td class="text-left">
                        {{ $info->ethnicity->title ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ศาสนา
                    </td>
                    <td class="text-left">
                        {{ $info->religion ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ขนาดเสื้อกิจกรรม
                    </td>
                    <td class="text-left">
                        {{ $info->shirt_size ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        ความถนัด ความสนใจพิเศษ
                    </td>
                    <td class="text-left">
                        {{ $info->interest ?? '-' }}
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
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

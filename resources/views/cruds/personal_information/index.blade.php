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
                        <strong>วัน เดือน ปีเกิด</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>น้ำหนัก / ส่วนสูง</strong>
                    </td>
                    <td class="text-left">
                        - / -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>อีเมล</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>เบอร์โทรศัพท์มือถือ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>การได้รับทุน</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ความพิการ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>หมู่โลหิต</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>สัญชาติ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>เชื้อชาติ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ศาสนา</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ขนาดเสื้อกิจกรรม</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ความถนัด ความสนใจพิเศษ</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>ที่อยู่</strong>
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

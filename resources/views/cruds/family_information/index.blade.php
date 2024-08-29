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
                        <strong>สถานะครอบครัว</strong>
                    </td>
                    <td class="w-3/4 text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>สถานที่ศึกษาเดิม</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>วุฒิการศึกษาเดิม</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>สำเร็จการศึกษาเมื่อปี พ.ศ.</strong>
                    </td>
                    <td class="text-left">
                        -
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <strong>เกรดเฉลี่ยที่สำเร็จการศึกษา</strong>
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

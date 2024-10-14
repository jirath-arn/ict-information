@extends('layouts.app')

@section('title', 'ประวัติการศึกษา')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>ประวัติการศึกษา</h1>
        <ul>
            <li>ประวัติการศึกษา</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a href="{{ route('education_information.edit') }}" class="btn btn_primary uppercase">
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
                        ระดับการศึกษาเดิม
                    </td>
                    <td class="w-3/4 text-left">
                        {{ $info->education ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สถานที่ศึกษาเดิม
                    </td>
                    <td class="text-left">
                        {{ $info->name_school ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        วุฒิการศึกษาเดิม
                    </td>
                    <td class="text-left">
                        {{ $info->qualification ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        สำเร็จการศึกษาเมื่อปี พ.ศ.
                    </td>
                    <td class="text-left">
                        {{ $info->graduate_year ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-right font-bold">
                        เกรดเฉลี่ยที่สำเร็จการศึกษา
                    </td>
                    <td class="text-left">
                        {{ $info->gpa ?? '-' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')
@endsection

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
        <x-student.education-info-component
            education="{{ $info->education ?? '-' }}"
            name-school="{{ $info->name_school ?? '-' }}"
            qualification="{{ $info->qualification ?? '-' }}"
            graduate-year="{{ $info->graduate_year ?? '-' }}"
            gpa="{{ $info->gpa ?? '-' }}"
        />
    </div>
</div>

@include('layouts.footer')
@endsection

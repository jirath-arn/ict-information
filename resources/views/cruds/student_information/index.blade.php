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
        <x-student-info-component
            student-id="{{ $info->student_id ?? '-' }}"
            full-name-with-prefix-th="{{ $info->full_name_with_prefix_th ?? '-' }}"
            full-name-with-prefix-en="{{ $info->full_name_with_prefix_en ?? '-' }}"
            rmutto-email="{{ $info->rmutto_email ?? '-' }}"
            student-status="{{ $info->student_status->title ?? '-' }}"
            level="{{ $info->level ?? '-' }}"
            year="{{ $info->year ?? '-' }}"
            advisor-full-name-with-prefix-th="{{ $info->advisor->full_name_with_prefix_th ?? '-' }}"
            advisor-tel="{{ $info->advisor->tel ?? '-' }}"
            advisor-rmutto-email="{{ $info->advisor->rmutto_email ?? '-' }}"
        />
    </div>
</div>

@include('layouts.footer')
@endsection

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
        <x-family-info-component
            family-status="{{ $info->family_status->title ?? '-' }}"
            father-full-name-th="{{ $info->father_full_name_th ?? '-' }}"
            father-full-name-en="{{ $info->father_full_name_en ?? '-' }}"
            father-life="{{ $info->father_life ?? '-' }}"
            father-income="{{ $info->father_income ?? '-' }}"
            father-career="{{ $info->father_career->title ?? '-' }}"
            mother-full-name-th="{{ $info->mother_full_name_th ?? '-' }}"
            mother-full-name-en="{{ $info->mother_full_name_en ?? '-' }}"
            mother-life="{{ $info->mother_life ?? '-' }}"
            mother-income="{{ $info->mother_income ?? '-' }}"
            mother-career="{{ $info->mother_career->title ?? '-' }}"
            relative-full-name-th="{{ $info->relative_full_name_th ?? '-' }}"
            relative-full-name-en="{{ $info->relative_full_name_en ?? '-' }}"
            relationship="{{ $info->relationship->title ?? '-' }}"
            relative-life="{{ $info->relative_life ?? '-' }}"
            relative-address="{{ $info->address ?? '-' }}"
            relative-income="{{ $info->relative_income ?? '-' }}"
            relative-career="{{ $info->relative_career->title ?? '-' }}"
        />
    </div>
</div>

@include('layouts.footer')
@endsection

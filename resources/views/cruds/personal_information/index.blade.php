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
        <x-personal-info-component
            birth-date="{{ $info->birth_date ?? '-' }}"
            weight="{{ $info->weight ?? '-' }}"
            height="{{ $info->height ?? '-' }}"
            email="{{ $info->email ?? '-' }}"
            tel="{{ $info->tel ?? '-' }}"
            scholarship="{{ $info->scholarship ?? '-' }}"
            disability="{{ $info->disability ?? '-' }}"
            blood-type="{{ $info->blood_type ?? '-' }}"
            nationality="{{ $info->nationality->title ?? '-' }}"
            ethnicity="{{ $info->ethnicity->title ?? '-' }}"
            religion="{{ $info->religion ?? '-' }}"
            shirt-size="{{ $info->shirt_size ?? '-' }}"
            interest="{{ $info->interest ?? '-' }}"
            address="{{ $info->address ?? '-' }}"
        />
    </div>
</div>

@include('layouts.footer')
@endsection

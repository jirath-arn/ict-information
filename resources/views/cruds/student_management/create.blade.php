@extends('layouts.app')

@section('title', 'เพิ่มข้อมูลนักศึกษา')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>เพิ่มข้อมูลนักศึกษา</h1>
        <ul>
            <li>
                <a href="{{ route('student_management.index') }}">จัดการข้อมูลนักศึกษา</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>เพิ่มข้อมูลนักศึกษา</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="createButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('student_management.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="createForm" action="{{ route('student_management.store') }}" method="POST">
            @csrf

            <x-student-update-component
                :prefix="$prefix"
                :student-status="$student_status"
                :current-year="$current_year"
                :transfer="$transfer"
                :advisors="$advisors"
            />
        </form>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        $('#createButton').click(function(e) {
            $('#createForm').submit();
        });
    });
</script>
@endsection

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

            <div class="tabs">
                <nav class="tab-nav">
                    <button id="studentTab" type="button" class="nav-link h5 active">ข้อมูลนักศึกษา</button>
                    <button id="personalTab" type="button" class="nav-link h5">ประวัติส่วนตัว</button>
                    <button id="familyTab" type="button" class="nav-link h5">ประวัติครอบครัว</button>
                    <button id="educationTab" type="button" class="nav-link h5">ประวัติการศึกษา</button>
                </nav>
                <div class="collapsible open mt-5">
                    <div id="studentContent">
{{--                        <x-student-update-component />--}}
                    </div>
                    <div id="personalContent" class="hidden">
                        <x-personal-update-component
                            :current-date="$current_date"
                            :scholarship="$scholarship"
                            :blood-type="$blood_type"
                            :religion="$religion"
                            :shirt-size="$shirt_size"
                            :countries="$countries"
                        />
                    </div>
                    <div id="familyContent" class="hidden">
                        <x-family-update-component
                            :family-status="$family_status"
                            :careers="$careers"
                            :relationship="$relationship"
                            :life="$life"
                            :income="$income"
                        />
                    </div>
                    <div id="educationContent" class="hidden">
                        <x-education-update-component
                            :current-year="$current_year"
                            :education="$education"
                        />
                    </div>
                </div>
            </div>
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

        // Tab.
        function changeTab() {
            $('.collapsible').children().addClass('hidden');
            $('.tab-nav').children().removeClass('active');
        }

        $('#studentTab').on('click', function () {
            changeTab();
            $(this).addClass('active');
            $('#studentContent').removeClass('hidden');
        });

        $('#personalTab').on('click', function () {
            changeTab();
            $(this).addClass('active');
            $('#personalContent').removeClass('hidden');
        });

        $('#familyTab').on('click', function () {
            changeTab();
            $(this).addClass('active');
            $('#familyContent').removeClass('hidden');
        });

        $('#educationTab').on('click', function () {
            changeTab();
            $(this).addClass('active');
            $('#educationContent').removeClass('hidden');
        });
    });
</script>
@endsection

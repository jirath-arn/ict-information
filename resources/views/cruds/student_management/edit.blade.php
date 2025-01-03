@extends('layouts.app')

@section('title', 'แก้ไขข้อมูลนักศึกษา')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขข้อมูลนักศึกษา</h1>
        <ul>
            <li>
                <a href="{{ route('student_management.index') }}">จัดการข้อมูลนักศึกษา</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>แก้ไขข้อมูลนักศึกษา</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
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
        <form id="updateForm" action="{{ route('student_management.update', $id) }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @method('PUT')
            @csrf

            <div class="tabs">
                <nav class="tab-nav">
                    <button id="studentTab" type="button" class="nav-link h5">ข้อมูลนักศึกษา</button>
                    <button id="personalTab" type="button" class="nav-link h5">ประวัติส่วนตัว</button>
                    <button id="familyTab" type="button" class="nav-link h5">ประวัติครอบครัว</button>
                    <button id="educationTab" type="button" class="nav-link h5">ประวัติการศึกษา</button>
                </nav>
                <div class="collapsible open mt-5">
                    <div id="studentContent" class="hidden">
                        <x-student.student-update-component
                            :info="$info"
                            :current-year="$current_year"
                            :prefix="$prefix"
                            :transfer="$transfer"
                            :student-status="$student_status"
                            :advisors="$advisors"
                        />
                    </div>
                    <div id="personalContent" class="hidden">
                        <x-student.personal-update-component
                            :info="$info"
                            :current-date="$current_date"
                            :scholarship="$scholarship"
                            :blood-type="$blood_type"
                            :religion="$religion"
                            :shirt-size="$shirt_size"
                            :countries="$countries"
                        />
                    </div>
                    <div id="familyContent" class="hidden">
                        <x-student.family-update-component
                            :info="$info"
                            :family-status="$family_status"
                            :careers="$careers"
                            :relationship="$relationship"
                            :life="$life"
                            :income="$income"
                        />
                    </div>
                    <div id="educationContent" class="hidden">
                        <x-student.education-update-component
                            :info="$info"
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
        $('#updateButton').click(function(e) {
            $('#updateForm').submit();
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

        // Fragment.
        const hash = window.location.hash;
        switch (hash) {
            case "#student_information":
                $('#studentTab').click();
                break;
            case "#personal_information":
                $('#personalTab').click();
                break;
            case "#family_information":
                $('#familyTab').click();
                break;
            case "#education_information":
                $('#educationTab').click();
                break;
            default:
                $('#studentTab').click();
                break;
        }
    });
</script>
@endsection

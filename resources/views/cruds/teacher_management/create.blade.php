@extends('layouts.app')

@section('title', 'เพิ่มข้อมูลอาจารย์')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>เพิ่มข้อมูลอาจารย์</h1>
        <ul>
            <li>
                <a href="{{ route('teacher_management.index') }}">จัดการข้อมูลอาจารย์</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>เพิ่มข้อมูลอาจารย์</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="createButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('teacher_management.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="createForm" action="{{ route('teacher_management.store') }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @csrf

            <x-teacher.teacher-update-component
                :prefix="$prefix"
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

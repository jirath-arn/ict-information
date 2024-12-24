@extends('layouts.app')

@section('title', 'แก้ไขข้อมูลอาจารย์')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขข้อมูลอาจารย์</h1>
        <ul>
            <li>
                <a href="{{ route('teacher_management.index') }}">จัดการข้อมูลอาจารย์</a>
            </li>
            <li class="divider la la-arrow-right"></li>
            <li>แก้ไขข้อมูลอาจารย์</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
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
        <form id="updateForm" action="{{ route('teacher_management.update', $id) }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @method('PUT')
            @csrf
            
            <x-teacher.teacher-update-component
                :info="$info"
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
        $('#updateButton').click(function(e) {
            $('#updateForm').submit();
        });
    });
</script>
@endsection

@extends('layouts.app')

@section('title', 'แก้ไขประวัติส่วนตัว')

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>แก้ไขประวัติส่วนตัว</h1>
        <ul>
            <li>แก้ไขประวัติส่วนตัว</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        <a id="updateButton" href="#" class="btn btn_success uppercase">
            <span class="la la-download text-xl leading-none mr-2"></span>
            บันทึก
        </a>

        <a href="{{ route('personal_information.index') }}" class="btn btn_danger uppercase">
            <span class="la la-times text-xl leading-none mr-2"></span>
            ยกเลิก
        </a>
    </div>
</div>

<div class="card">
    <div class="overflow-x-auto p-10">
        <form id="updateForm" action="{{ route('personal_information.update') }}" method="POST" onsubmit="return confirm('ยืนยันบันทึกข้อมูลหรือไม่ ?');">
            @csrf

            <x-student.personal-update-component
                :info="$info"
                :current-date="$current_date"
                :scholarship="$scholarship"
                :blood-type="$blood_type"
                :religion="$religion"
                :shirt-size="$shirt_size"
                :countries="$countries"
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

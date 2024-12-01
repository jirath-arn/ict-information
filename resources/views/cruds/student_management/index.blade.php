@extends('layouts.app')

@section('title', 'จัดการข้อมูลนักศึกษา')

@section('styles')
@php
    use App\Helpers\Auth;
    use App\Helpers\Date;
    use App\Helpers\Tel;
    use App\Enums\Role;
@endphp
@endsection

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>จัดการข้อมูลนักศึกษา</h1>
        <ul>
            <li>จัดการข้อมูลนักศึกษา</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        {{-- Search --}}
        <form id="searchForm" action="{{ route('student_management.index') }}" method="GET" class="flex flex-auto">
            <label class="form-control-addon-within rounded-full">
                <input name="search" type="search" value="{{ request()->query('search', '') }}" class="form-control border-none" placeholder="ค้นหา" />
                <button type="submit" class="text-gray-300 text-xl leading-none la la-search mr-4"></button>
            </label>
        </form>

        <div class="flex gap-x-2">
            {{-- Sort By --}}
            <div id="sortByTooltip" class="hidden">
                <div class="dropdown-menu">
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'student_id', 'sort_direction' => 'asc'])) }}">ค่าเริ่มต้น</a>
                    <hr />
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_th', 'sort_direction' => 'asc'])) }}">ชื่อ - นามสกุล (ก - ฮ)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_th', 'sort_direction' => 'desc'])) }}">ชื่อ - นามสกุล (ฮ - ก)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'level', 'sort_direction' => 'asc'])) }}">ชั้นปี (น้อย - มาก)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'level', 'sort_direction' => 'desc'])) }}">ชั้นปี (มาก - น้อย)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'student_id', 'sort_direction' => 'asc'])) }}">รหัสนักศึกษา (น้อย - มาก)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'student_id', 'sort_direction' => 'desc'])) }}">รหัสนักศึกษา (มาก - น้อย)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_en', 'sort_direction' => 'asc'])) }}">Full Name (A - Z)</a>
                    <a href="{{ route('student_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_en', 'sort_direction' => 'desc'])) }}">Full Name (Z - A)</a>
                </div>
            </div>

            <button id="sortBy" class="btn btn_secondary btn_outlined uppercase">
                จัดเรียงตาม
                <span class="ml-3 la la-caret-down text-xl leading-none"></span>
            </button>

            @if(Auth::getRoleEN() == Role::ADMIN)
                <a href="{{ route('student_management.create') }}" class="btn btn_primary uppercase">
                    เพิ่มนักศึกษาใหม่
                </a>
            @endif
        </div>
    </div>
</div>

{{-- List --}}
<div class="card p-5">
    <div class="overflow-x-auto">
        <table class="table table-auto table_hoverable w-full">
            <thead>
                <tr>
                    <th class="text-center uppercase">#</th>
                    <th class="text-center uppercase">รหัสนักศึกษา</th>
                    <th class="text-center uppercase">คำนำหน้า</th>
                    <th class="text-center uppercase">ชื่อ - นามสกุล</th>
                    <th class="text-center uppercase">Prefix</th>
                    <th class="text-center uppercase">Full Name</th>
                    <th class="text-center uppercase">ปี</th>
                    <th class="text-center uppercase">สถานะ</th>
                    @if(Auth::getRoleEN() == Role::ADMIN)
                        <th class="text-center uppercase">อาจารย์ที่ปรึกษา</th>
                    @endif
                    <th class="uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $idx => $student)
                    <tr>
                        <td class="text-center">{{ $students->firstItem() + $idx }}</td>
                        <td class="text-center">{{ $student->username }}</td>
                        <td class="text-center">{{ Auth::convertPrefixFromENToTH($student->prefix) }}</td>
                        <td class="text-center">{{ $student->first_name_th.' '.$student->last_name_th }}</td>
                        <td class="text-center capitalize">{{ strtolower($student->prefix) }}</td>
                        <td class="text-center capitalize">{{ strtolower($student->first_name_en.' '.$student->last_name_en) }}</td>
                        <td class="text-center">{{ $student->level.' / '.Date::convertFromADToBE($student->year) }}</td>
                        <td class="text-center">{{ $student->student_status->title }}</td>
                        @if(Auth::getRoleEN() == Role::ADMIN)
                            <td class="text-center">
                                @php
                                    $advisor = $student->advisor;
                                    echo $advisor->first_name_th.' '.$advisor->last_name_th;
                                @endphp
                            </td>
                        @endif
                        <td class="text-right whitespace-nowrap">
                            <div class="inline-flex ml-auto">
                                @php
                                    $advisor = $student->advisor;
                                    $user = $student->user;
                                    $education = $user->education_information;
                                    $personal = $user->personal_information;
                                    $family = $user->family_information;
                                @endphp

                                <button
                                    data-toggle="modal"
                                    data-target="#detailModal"
                                    class="btn btn-icon btn_outlined btn_secondary"

                                    data-student_id="{{ $student->username ?? '-' }}"
                                    data-full_name_th="{{ $student->first_name_th.' '.$student->last_name_th ?? '-' }}"
                                    data-full_name_with_prefix_th="{{ Auth::convertPrefixFromENToTH($student->prefix).' '.$student->first_name_th.' '.$student->last_name_th ?? '-' }}"
                                    data-full_name_with_prefix_en="{{ Auth::formatPrefix($student->prefix).' '.$student->first_name_en.' '.$student->last_name_en ?? '-' }}"
                                    data-rmutto_email="{{ $student->rmutto_email ?? '-' }}"
                                    data-student_status="{{ $student->student_status->title ?? '-' }}"
                                    data-level="{{ $student->level ?? '-' }}"
                                    data-year="{{ Date::convertFromADToBE($student->year) ?? '-' }}"
                                    data-advisor_full_name_with_prefix_th="{{ Auth::convertPrefixFromENToTH($advisor->prefix).' '.$advisor->first_name_th.' '.$advisor->last_name_th ?? '-' }}"
                                    data-advisor_tel="{{ Tel::format($advisor->tel) ?? '-' }}"
                                    data-advisor_rmutto_email="{{ $advisor->rmutto_email ?? '-' }}"

                                    data-birth_date="{{ Date::convertToBirthDate($personal->birth_date) ?? '-' }}"
                                    data-weight="{{ $personal->weight ?? '-' }}"
                                    data-height="{{ $personal->height ?? '-' }}"
                                    data-email="{{ $personal->email ?? '-' }}"
                                    data-tel="{{ Tel::format($user->tel) ?? '-' }}"
                                    data-scholarship="{{ Auth::convertScholarshipFromENToTH($personal->scholarship) ?? '-' }}"
                                    data-disability="{{ $personal->disability ?? '-' }}"
                                    data-blood_type="{{ $personal->blood_type ?? '-' }}"
                                    data-nationality="{{ $personal->nationality_info->title ?? '-' }}"
                                    data-ethnicity="{{ $personal->ethnicity_info->title ?? '-' }}"
                                    data-religion="{{ Auth::convertReligionFromENToTH($personal->religion) ?? '-' }}"
                                    data-shirt_size="{{ $personal->shirt_size ?? '-' }}"
                                    data-interest="{{ $personal->interest ?? '-' }}"
                                    data-address="{{ $personal->address ?? '-' }}"

                                    data-family_status="{{ $family->family_status->title ?? '-' }}"
                                    data-father_full_name_th="{{ $family->father_first_name_th.' '.$family->father_last_name_th ?? '-' }}"
                                    data-father_full_name_en="{{ $family->father_first_name_en.' '.$family->father_last_name_en ?? '-' }}"
                                    data-father_life="{{ Auth::convertLifeFromENToTH($family->father_life) ?? '-' }}"
                                    data-father_income="{{ Auth::convertIncomeFromENToTH($family->father_income) ?? '-' }}"
                                    data-father_career="{{ $family->father_career->title ?? '-' }}"
                                    data-mother_full_name_th="{{ $family->mother_first_name_th.' '.$family->mother_last_name_th ?? '-' }}"
                                    data-mother_full_name_en="{{ $family->mother_first_name_en.' '.$family->mother_last_name_en ?? '-' }}"
                                    data-mother_life="{{ Auth::convertLifeFromENToTH($family->mother_life) ?? '-' }}"
                                    data-mother_income="{{ Auth::convertIncomeFromENToTH($family->mother_income) ?? '-' }}"
                                    data-mother_career="{{ $family->mother_career->title ?? '-' }}"
                                    data-relative_full_name_th="{{ $family->relative_first_name_th.' '.$family->relative_last_name_th ?? '-' }}"
                                    data-relative_full_name_en="{{ $family->relative_first_name_en.' '.$family->relative_last_name_en ?? '-' }}"
                                    data-relationship="{{ $family->relationship->title ?? '-' }}"
                                    data-relative_life="{{ Auth::convertLifeFromENToTH($family->relative_life) ?? '-' }}"
                                    data-relative_address="{{ $family->address ?? '-' }}"
                                    data-relative_income="{{ Auth::convertIncomeFromENToTH($family->relative_income) ?? '-' }}"
                                    data-relative_career="{{ $family->relative_career->title ?? '-' }}"

                                    data-education="{{ Auth::convertEducationFromENToTH($education->education) ?? '-' }}"
                                    data-name_school="{{ $education->name_school ?? '-' }}"
                                    data-qualification="{{ $education->qualification ?? '-' }}"
                                    data-graduate_year="{{ Date::convertFromADToBE($education->graduate_year) ?? '-' }}"
                                    data-gpa="{{ $education->gpa ?? '-' }}"
                                >
                                    <span class="la la-ellipsis-v"></span>
                                </button>

                                @if(Auth::getRoleEN() == Role::ADMIN)
                                    <a href="{{ route('student_management.edit', $student->id) }}" class="btn btn-icon btn_outlined btn_secondary ml-2">
                                        <span class="la la-edit"></span>
                                    </a>

                                    <form action="{{ route('student_management.destroy', $student->id).'?'.http_build_query(request()->query()) }}" method="POST" onsubmit="return confirm('ยืนยันลบข้อมูลหรือไม่ ?');">
                                        @method('DELETE')
                                        @csrf

                                        <button type="submit" class="btn btn-icon btn_outlined btn_danger ml-2">
                                            <span class="la la-trash-alt"></span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div>
    {{ $students->appends(request()->query())->onEachSide(1)->links('components.student.paginator') }}
</div>

{{-- Modal --}}
<div id="detailModal" class="hidden">
    <div class="backdrop active"></div>
    <div class="modal active">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content w-full">
                <div class="modal-header">
                    <h2 class="modal-title"></h2>
                    <button class="close la la-times"></button>
                </div>
                <div class="modal-body">
                    <div class="tabs">
                        <nav class="tab-nav">
                            <button id="studentTab" class="nav-link h5 active">ข้อมูลนักศึกษา</button>
                            <button id="personalTab" class="nav-link h5">ประวัติส่วนตัว</button>
                            <button id="familyTab" class="nav-link h5">ประวัติครอบครัว</button>
                            <button id="educationTab" class="nav-link h5">ประวัติการศึกษา</button>
                        </nav>
                        <div class="collapsible open mt-5">
                            <div id="studentContent"></div>
                            <div id="personalContent" class="hidden"></div>
                            <div id="familyContent" class="hidden"></div>
                            <div id="educationContent" class="hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="flex ml-auto">
                        <button class="close btn btn_secondary">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        // Initialize Tippy.js Tooltip.
        tippy('#sortBy', {
            content: $('#sortByTooltip').html(),
            trigger: 'click',
            theme: 'light-border',
            offset: [0, 8],
            arrow: false,
            placement: 'bottom-start',
            interactive: true,
            allowHTML: true,
            animation: 'shift-toward-extreme',
            appendTo: document.body
        });

        // Initialize Tippy.js Tooltip.
        tippy('#listSize', {
            content: $('#listSizeTooltip').html(),
            trigger: 'click',
            theme: 'light-border',
            offset: [0, 8],
            arrow: false,
            placement: 'bottom-start',
            interactive: true,
            allowHTML: true,
            animation: 'shift-toward-extreme',
            appendTo: document.body
        });

        // Search.
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.set('search', $('input[name="search"]').val());
            urlParams.set('page', '1');
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });

        // Modal.
        $('[data-toggle="modal"]').on('click', function () {
            const m = $(this);
            $('.modal-title').text(m.data('full_name_th'));
            $('#studentContent').html(`
                <x-student.student-info-component
                    student-id="${m.data(`student_id`)}"
                    full-name-with-prefix-th="${m.data(`full_name_with_prefix_th`)}"
                    full-name-with-prefix-en="${m.data(`full_name_with_prefix_en`)}"
                    rmutto-email="${m.data(`rmutto_email`)}"
                    student-status="${m.data(`student_status`)}"
                    level="${m.data(`level`)}"
                    year="${m.data(`year`)}"
                    advisor-full-name-with-prefix-th="${m.data(`advisor_full_name_with_prefix_th`)}"
                    advisor-tel="${m.data(`advisor_tel`)}"
                    advisor-rmutto-email="${m.data(`advisor_rmutto_email`)}"
                />`
            );
            $('#personalContent').html(`
                <x-student.personal-info-component
                    birth-date="${m.data(`birth_date`)}"
                    weight="${m.data(`weight`)}"
                    height="${m.data(`height`)}"
                    email="${m.data(`email`)}"
                    tel="${m.data(`tel`)}"
                    scholarship="${m.data(`scholarship`)}"
                    disability="${m.data(`disability`)}"
                    blood-type="${m.data(`blood_type`)}"
                    nationality="${m.data(`nationality`)}"
                    ethnicity="${m.data(`ethnicity`)}"
                    religion="${m.data(`religion`)}"
                    shirt-size="${m.data(`shirt_size`)}"
                    interest="${m.data(`interest`)}"
                    address="${m.data(`address`)}"
                />`
            );
            $('#familyContent').html(`
                <x-student.family-info-component
                    family-status="${m.data(`family_status`)}"
                    father-full-name-th="${m.data(`father_full_name_th`)}"
                    father-full-name-en="${m.data(`father_full_name_en`)}"
                    father-life="${m.data(`father_life`)}"
                    father-income="${m.data(`father_income`)}"
                    father-career="${m.data(`father_career`)}"
                    mother-full-name-th="${m.data(`mother_full_name_th`)}"
                    mother-full-name-en="${m.data(`mother_full_name_en`)}"
                    mother-life="${m.data(`mother_life`)}"
                    mother-income="${m.data(`mother_income`)}"
                    mother-career="${m.data(`mother_career`)}"
                    relative-full-name-th="${m.data(`relative_full_name_th`)}"
                    relative-full-name-en="${m.data(`relative_full_name_en`)}"
                    relationship="${m.data(`relationship`)}"
                    relative-life="${m.data(`relative_life`)}"
                    relative-address="${m.data(`relative_address`)}"
                    relative-income="${m.data(`relative_income`)}"
                    relative-career="${m.data(`relative_career`)}"
                />`
            );
            $('#educationContent').html(`
                <x-student.education-info-component
                    education="${m.data(`education`)}"
                    name-school="${m.data(`name_school`)}"
                    qualification="${m.data(`qualification`)}"
                    graduate-year="${m.data(`graduate_year`)}"
                    gpa="${m.data(`gpa`)}"
                />`
            );

            document.body.classList.add('backdrop-show');
            $('#studentTab').click();
            $('#detailModal').removeClass('hidden');
        });

        $('.close').on('click', function () {
            document.body.classList.remove('backdrop-show');
            $('#detailModal').addClass('hidden');
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

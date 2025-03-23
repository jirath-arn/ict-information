@extends('layouts.app')

@section('title', 'จัดการข้อมูลอาจารย์')

@section('styles')
@php
    use App\Helpers\Auth;
    use App\Helpers\Tel;
@endphp
@endsection

@section('content')
<div class="lg:flex items-start">
    <section class="breadcrumb">
        <h1>จัดการข้อมูลอาจารย์</h1>
        <ul>
            <li>จัดการข้อมูลอาจารย์</li>
        </ul>
    </section>

    <div class="flex flex-wrap gap-2 items-center ml-auto mb-5">
        {{-- Search --}}
        <form id="searchForm" action="{{ route('teacher_management.index') }}" method="GET" class="flex flex-auto">
            <label class="form-control-addon-within rounded-full">
                <input name="search" type="search" value="{{ request()->query('search', '') }}" class="form-control border-none" placeholder="ค้นหา" />
                <button type="submit" class="text-gray-300 text-xl leading-none la la-search mr-4"></button>
            </label>
        </form>

        <div class="flex gap-x-2">
            {{-- Sort By --}}
            <div id="sortByTooltip" class="hidden">
                <div class="dropdown-menu">
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'employee_id', 'sort_direction' => 'asc'])) }}">ค่าเริ่มต้น</a>
                    <hr />
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_th', 'sort_direction' => 'asc'])) }}">ชื่อ - นามสกุล (ก - ฮ)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_th', 'sort_direction' => 'desc'])) }}">ชื่อ - นามสกุล (ฮ - ก)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'employee_id', 'sort_direction' => 'asc'])) }}">รหัสอาจารย์ (น้อย - มาก)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'employee_id', 'sort_direction' => 'desc'])) }}">รหัสอาจารย์ (มาก - น้อย)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'rmutto_email', 'sort_direction' => 'asc'])) }}">อีเมล Rmutto (น้อย - มาก)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'rmutto_email', 'sort_direction' => 'desc'])) }}">อีเมล Rmutto (มาก - น้อย)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_en', 'sort_direction' => 'asc'])) }}">Full Name (A - Z)</a>
                    <a href="{{ route('teacher_management.index', array_merge(request()->query(), ['sort_by' => 'full_name_en', 'sort_direction' => 'desc'])) }}">Full Name (Z - A)</a>
                </div>
            </div>

            <button id="sortBy" class="btn btn_secondary btn_outlined uppercase">
                จัดเรียงตาม
                <span class="ml-3 la la-caret-down text-xl leading-none"></span>
            </button>

            <a href="{{ route('teacher_management.create') }}" class="btn btn_primary uppercase">
                เพิ่มอาจารย์ใหม่
            </a>

            <form id="excelForm" action="{{ route('teacher_management.import_excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input id="excelFile" name="excel_file" type="file" class="hidden" accept=".xls,.xlsx" />
                <button id="importExcel" class="btn btn_primary uppercase">
                    นำเข้า Excel
                </button>
            </form>
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
                    <th class="text-center uppercase">รหัสอาจารย์</th>
                    <th class="text-center uppercase">คำนำหน้า</th>
                    <th class="text-center uppercase">ชื่อ - นามสกุล</th>
                    <th class="text-center uppercase">Prefix</th>
                    <th class="text-center uppercase">Full Name</th>
                    <th class="text-center uppercase">อีเมล Rmutto</th>
                    <th class="text-center uppercase">เบอร์โทรศัพท์</th>
                    <th class="uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $idx => $teacher)
                    <tr>
                        <td class="text-center">{{ $teachers->firstItem() + $idx }}</td>
                        <td class="text-center">{{ $teacher->username }}</td>
                        <td class="text-center">{{ Auth::convertPrefixFromENToTH($teacher->prefix) }}</td>
                        <td class="text-center">{{ $teacher->first_name_th.' '.$teacher->last_name_th }}</td>
                        <td class="text-center capitalize">{{ strtolower($teacher->prefix) }}</td>
                        <td class="text-center capitalize">{{ strtolower($teacher->first_name_en.' '.$teacher->last_name_en) }}</td>
                        <td class="text-center">{{ $teacher->rmutto_email }}</td>
                        <td class="text-center">{{ Tel::format($teacher->tel) ?? '-' }}</td>
                        <td class="text-right whitespace-nowrap">
                            <div class="inline-flex ml-auto">
                                <a href="{{ route('teacher_management.edit', $teacher->id) }}" class="btn btn-icon btn_outlined btn_secondary ml-2">
                                    <span class="la la-edit"></span>
                                </a>

                                <form action="{{ route('teacher_management.destroy', $teacher->id).'?'.http_build_query(request()->query()) }}" method="POST" onsubmit="return confirm('ยืนยันลบข้อมูลหรือไม่ ?');">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" class="btn btn-icon btn_outlined btn_danger ml-2">
                                        <span class="la la-trash-alt"></span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                @if(count($teachers) == 0)
                    <tr>
                        <td id="emptyData" class="text-center">ไม่มีข้อมูล</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div>
    {{ $teachers->appends(request()->query())->onEachSide(1)->links('components.teacher.paginator') }}
</div>

@include('layouts.footer')
@endsection

@section('scripts')
<script type="module">
    $(document).ready(function() {
        @error('excel')
            alert("{{ $message }}");
        @enderror

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

        // Excel File.
        $('#importExcel').on('click', function (e) {
            e.preventDefault();
            $('#excelFile').click();
        });

        $('#excelFile').on('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                $('#excelForm').submit();
            }
        });

        // Empty Table.
        const countHeader = $('table thead th').length;
        $('#emptyData').attr('colspan', countHeader);

        // Search.
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.set('search', $('input[name="search"]').val());
            urlParams.set('page', '1');
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });
    });
</script>
@endsection

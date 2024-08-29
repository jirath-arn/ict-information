@extends('layouts.app')

@section('title', 'จัดการข้อมูลนักศึกษา')

@section('styles')
@php
    use App\Enums\Prefix;
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
        <form class="flex flex-auto">
            <label class="form-control-addon-within rounded-full">
                <input type="search" class="form-control border-none" placeholder="ค้นหา" />
                <button class="text-gray-300 text-xl leading-none la la-search mr-4"></button>
            </label>
        </form>

        <div class="flex gap-x-2">
            {{-- Sort By --}}
            <div id="sortByTooltip" class="hidden">
                <div class="dropdown-menu">
                    <a href="#">น้อย - มาก</a>
                    <a href="#">มาก - น้อย</a>
                </div>
            </div>

            <button id="sortBy" class="btn btn_secondary btn_outlined uppercase">
                จัดเรียงตาม
                <span class="ml-3 la la-caret-down text-xl leading-none"></span>
            </button>
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
                    <th class="text-center uppercase">คำนำหน้า</th>
                    <th class="text-center uppercase">ชื่อ - นามสกุล</th>
                    <th class="text-center uppercase">Prefix</th>
                    <th class="text-center uppercase">Full Name</th>
                    <th class="text-center uppercase">ปี</th>
                    <th class="text-center uppercase">สถานะ</th>
                    <th class="uppercase"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="text-center">{{ $student->id }}</td>
                        <td class="text-center">
                            @if ($student->prefix == Prefix::MR)
                                นาย
                            @elseif ($student->prefix == Prefix::MISS)
                                นางสาว
                            @else
                                นาง
                            @endif
                        </td>
                        <td class="text-center">{{ $student->first_name_th }} {{ $student->last_name_th }}</td>
                        <td class="text-center capitalize">{{ strtolower($student->prefix) }}</td>
                        <td class="text-center capitalize">{{ $student->first_name_en }} {{ $student->last_name_en }}</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-right whitespace-nowrap">
                            <div class="inline-flex ml-auto">
                                <a href="#" class="btn btn-icon btn_outlined btn_secondary">
                                    <span class="la la-ellipsis-v"></span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="card lg:flex mt-5">
    <nav class="flex items-center flex-wrap gap-2 p-5">
        {{-- Prev --}}
        <button class="btn btn_secondary">ก่อนหน้า</button>

        {{-- Next --}}
        <button class="btn btn_secondary">ถัดไป</button>
    </nav>

    <div class="flex items-center ml-auto p-5 border-t lg:border-t-0 border-divider">
        แสดง {displayingFrom}-{displayingTo} จาก {totalCount} รายการ
    </div>

    <div class="flex items-center gap-2 p-5 border-t lg:border-t-0 lg:border-l border-divider">
        <span>นำเสนอ</span>

        <div id="listSizeTooltip" class="hidden">
            <div class="dropdown-menu">
                <button>5</button>
                <button>10</button>
                <button>15</button>
                <button>20</button>
            </div>
        </div>

        <button id="listSize" class="btn btn_secondary btn_outlined uppercase">
            5
            <span class="ml-3 la la-caret-down text-xl leading-none"></span>
        </button>

        <span>รายการ</span>
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
    });
</script>
@endsection

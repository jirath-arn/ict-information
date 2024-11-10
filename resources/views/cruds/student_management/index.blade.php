@extends('layouts.app')

@section('title', 'จัดการข้อมูลนักศึกษา')

@section('styles')
@php
    use App\Helpers\Auth;
    use App\Helpers\Date;
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
                    <th class="text-center uppercase">อาจารย์ที่ปรึกษา</th>
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
                        <td class="text-center">
                            @php
                                $advisor = $student->advisor;
                                echo $advisor->first_name_th.' '.$advisor->last_name_th;
                            @endphp
                        </td>
                        <td class="text-right whitespace-nowrap">
                            <div class="inline-flex ml-auto">
                                <button
                                    data-toggle="modal"
                                    data-target="#detailModal"
                                    class="btn btn-icon btn_outlined btn_secondary"
                                    data-full_name_th="{{ $student->first_name_th.' '.$student->last_name_th }}"
                                >
                                    <span class="la la-ellipsis-v"></span>
                                </button>
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
    {{ $students->appends(request()->query())->onEachSide(1)->links('component.paginator') }}
</div>

{{-- Modal --}}
<div id="detailModal" class="hidden">
    <div class="backdrop active"></div>
    <div class="modal active">
        <div class="modal-dialog max-w-2xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title"></h2>
                    <button class="close la la-times"></button>
                </div>
                <div class="modal-body">
                    <div class="tabs">
                        <nav class="tab-nav">
                            <button class="nav-link h5 active">ข้อมูลนักศึกษา</button>
                            <button class="nav-link h5">ประวัติส่วนตัว</button>
                            <button class="nav-link h5">ประวัติครอบครัว</button>
                            <button class="nav-link h5">ประวัติการศึกษา</button>
                        </nav>
                        <div class="collapsible open mt-5">
                            <div>
                                1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi
                                veritatis officiis, quidem placeat autem nihil voluptatem velit
                                quaerat adipisci veniam iste. Quae odio sint dolorum aliquid eos
                                numquam est ducimus! Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Itaque enim alias odit facilis, necessitatibus
                                quam nulla! Sapiente nostrum nulla ut, aspernatur nisi unde enim
                                quas ipsam laudantium excepturi vel consequuntur. Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Commodi veritatis
                                officiis, quidem placeat autem nihil voluptatem velit quaerat
                                adipisci veniam iste. Quae odio sint dolorum aliquid eos numquam
                                est ducimus! Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Itaque enim alias odit facilis, necessitatibus quam nulla!
                                Sapiente nostrum nulla ut, aspernatur nisi unde enim quas ipsam
                                laudantium excepturi vel consequuntur.
                            </div>
                            <div class="hidden">
                                2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi
                                veritatis officiis, quidem placeat autem nihil voluptatem velit
                                quaerat adipisci veniam iste. Quae odio sint dolorum aliquid eos
                                numquam est ducimus! Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Itaque enim alias odit facilis, necessitatibus
                                quam nulla! Sapiente nostrum nulla ut, aspernatur nisi unde enim
                                quas ipsam laudantium excepturi vel consequuntur. Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Commodi veritatis
                                officiis, quidem placeat autem nihil voluptatem velit quaerat
                                adipisci veniam iste. Quae odio sint dolorum aliquid eos numquam
                                est ducimus! Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Itaque enim alias odit facilis, necessitatibus quam nulla!
                                Sapiente nostrum nulla ut, aspernatur nisi unde enim quas ipsam
                                laudantium excepturi vel consequuntur.
                            </div>
                            <div class="hidden">
                                3. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi
                                veritatis officiis, quidem placeat autem nihil voluptatem velit
                                quaerat adipisci veniam iste. Quae odio sint dolorum aliquid eos
                                numquam est ducimus! Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Itaque enim alias odit facilis, necessitatibus
                                quam nulla! Sapiente nostrum nulla ut, aspernatur nisi unde enim
                                quas ipsam laudantium excepturi vel consequuntur. Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Commodi veritatis
                                officiis, quidem placeat autem nihil voluptatem velit quaerat
                                adipisci veniam iste. Quae odio sint dolorum aliquid eos numquam
                                est ducimus! Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Itaque enim alias odit facilis, necessitatibus quam nulla!
                                Sapiente nostrum nulla ut, aspernatur nisi unde enim quas ipsam
                                laudantium excepturi vel consequuntur.
                            </div>
                            <div class="hidden">
                                4. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi
                                veritatis officiis, quidem placeat autem nihil voluptatem velit
                                quaerat adipisci veniam iste. Quae odio sint dolorum aliquid eos
                                numquam est ducimus! Lorem ipsum dolor, sit amet consectetur
                                adipisicing elit. Itaque enim alias odit facilis, necessitatibus
                                quam nulla! Sapiente nostrum nulla ut, aspernatur nisi unde enim
                                quas ipsam laudantium excepturi vel consequuntur. Lorem ipsum
                                dolor sit amet consectetur adipisicing elit. Commodi veritatis
                                officiis, quidem placeat autem nihil voluptatem velit quaerat
                                adipisci veniam iste. Quae odio sint dolorum aliquid eos numquam
                                est ducimus! Lorem ipsum dolor, sit amet consectetur adipisicing
                                elit. Itaque enim alias odit facilis, necessitatibus quam nulla!
                                Sapiente nostrum nulla ut, aspernatur nisi unde enim quas ipsam
                                laudantium excepturi vel consequuntur.
                            </div>
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

        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.set('search', $('input[name="search"]').val());
            window.location.href = window.location.pathname + '?' + urlParams.toString();
        });

        $('[data-toggle="modal"]').on('click', function () {
            $('.modal-title').text($(this).data('full_name_th'));
            document.body.classList.add('backdrop-show');
            $('#detailModal').removeClass('hidden');
        });

        $('.close').on('click', function () {
            document.body.classList.remove('backdrop-show');
            $('#detailModal').addClass('hidden');
        });
    });
</script>
@endsection

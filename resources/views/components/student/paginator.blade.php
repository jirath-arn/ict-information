<div class="card lg:flex mt-5">
    <nav class="flex items-center flex-wrap gap-2 p-5">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <button class="btn btn_secondary" disabled>ก่อนหน้า</button>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn_secondary">ก่อนหน้า</a>
        @endif

        {{-- Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="la la-ellipsis-h text-2xl"></span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <button class="btn btn_primary">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="btn btn_secondary btn_outlined">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn_secondary">ถัดไป</a>
        @else
            <button class="btn btn_secondary" disabled>ถัดไป</button>
        @endif
    </nav>

    <div class="flex items-center ml-auto p-5 border-t lg:border-t-0 border-divider">
        แสดง {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} จาก {{ $paginator->total() }} รายการ
    </div>

    <div class="flex items-center gap-2 p-5 border-t lg:border-t-0 lg:border-l border-divider">
        <div id="listSizeTooltip" class="hidden">
            <div class="dropdown-menu">
                <a href="{{ route('student_management.index', array_merge(request()->query(), ['per_page' => 5, 'page' => 1])) }}">5</a>
                <a href="{{ route('student_management.index', array_merge(request()->query(), ['per_page' => 10, 'page' => 1])) }}">10</a>
                <a href="{{ route('student_management.index', array_merge(request()->query(), ['per_page' => 15, 'page' => 1])) }}">15</a>
                <a href="{{ route('student_management.index', array_merge(request()->query(), ['per_page' => 20, 'page' => 1])) }}">20</a>
            </div>
        </div>

        <button id="listSize" class="btn btn_secondary btn_outlined uppercase">
            {{ request('per_page') ?? 5 }}
            <span class="ml-3 la la-caret-down text-xl leading-none"></span>
        </button>

        <span>รายการ</span>
    </div>
</div>

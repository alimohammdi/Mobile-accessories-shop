{{-- resources/views/components/pagination.blade.php --}}

@if ($paginator->hasPages())
<div class="pagination">

    {{-- دکمه قبلی --}}
    @if ($paginator->onFirstPage())
        <span class="page-btn arrow disabled"><i class="ti ti-chevron-right"></i></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-btn arrow">
            <i class="ti ti-chevron-right"></i>
        </a>
    @endif

    {{-- شماره‌ها --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="page-btn">...</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- دکمه بعدی --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-btn arrow">
            <i class="ti ti-chevron-left"></i>
        </a>
    @else
        <span class="page-btn arrow disabled"><i class="ti ti-chevron-left"></i></span>
    @endif

</div>
@endif

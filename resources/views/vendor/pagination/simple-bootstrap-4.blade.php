@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.previous')</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() . '&' . http_build_query(request()->except('page')) }}" rel="prev">@lang('pagination.previous')</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @php
                    $currentPage = $paginator->currentPage();
                    $lastPage = $paginator->lastPage();
                    
                    // Always show 4 pages
                    if ($currentPage <= 2) {
                        // First two pages: show 1-4
                        $startPage = 1;
                        $endPage = min(4, $lastPage);
                    } elseif ($currentPage >= $lastPage - 1) {
                        // Last two pages: show last 4 pages
                        $startPage = max(1, $lastPage - 3);
                        $endPage = $lastPage;
                    } else {
                        // Middle pages: show current page and surrounding pages
                        $startPage = $currentPage - 1;
                        $endPage = $currentPage + 2;
                    }
                @endphp

                @foreach ($element as $page => $url)
                    @if ($page >= $startPage && $page <= $endPage)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url . '&' . http_build_query(request()->except('page')) }}">{{ $page }}</a></li>
                        @endif
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() . '&' . http_build_query(request()->except('page')) }}" rel="next">@lang('pagination.next')</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true">
                <span class="page-link">@lang('pagination.next')</span>
            </li>
        @endif
    </ul>
@endif

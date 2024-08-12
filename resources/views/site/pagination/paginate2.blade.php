@if ($paginator->hasPages())
    <div class="col-lg-12 col-md-12">
        <div class="pagination-area">
            @if (!$paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}" class="prev page-numbers">
                    <i class='bx bx-chevron-left'></i>
                </a>
            @endif

                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-numbers current" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-numbers">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers">
                        <i class='bx bx-chevron-right'></i>
                    </a>
                @endif
        </div>
    </div>
@endif


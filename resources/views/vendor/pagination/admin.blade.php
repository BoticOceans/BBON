@if ($paginator->hasPages())
    <nav class="pager" role="navigation" aria-label="Pagination">
        <div class="pager-info muted">
            Showing {{ $paginator->firstItem() }}&ndash;{{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>
        <div class="pager-links">
            @if ($paginator->onFirstPage())
                <span class="btn pager-btn is-disabled" aria-disabled="true">&larr; Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn pager-btn" rel="prev">&larr; Previous</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="pager-dots">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="btn pager-btn is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="btn pager-btn">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn pager-btn" rel="next">Next &rarr;</a>
            @else
                <span class="btn pager-btn is-disabled" aria-disabled="true">Next &rarr;</span>
            @endif
        </div>
    </nav>
@endif

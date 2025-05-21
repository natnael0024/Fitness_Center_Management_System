@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center mt-4">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-3 py-2 shadow-sm text-muted bg-light border-0">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-pill px-3 py-2 shadow-sm bg-white border-0" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Dots --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link rounded-pill px-3 py-2 shadow-sm text-muted bg-light border-0">{{ $element }}</span>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link rounded-pill px-3 py-2 shadow text-white bg-primary border-0">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-pill px-3 py-2 bg-gray-400 text-white border-0" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-pill px-3 py-2 shadow-sm bg-white border-0" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-pill px-3 py-2 shadow-sm text-muted bg-light border-0">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

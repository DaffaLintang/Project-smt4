@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2 my-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 border rounded">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-3 py-1 text-blue-600 border rounded hover:bg-blue-50">Previous</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            {{-- Tiga titik --}}
            @if (is_string($element))
                <span class="px-3 py-1">…</span>
            @endif

            {{-- Array link halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-1 bg-blue-600 text-white rounded">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-3 py-1 text-blue-600 border rounded hover:bg-blue-50">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1 text-blue-600 border rounded hover:bg-blue-50">Next</a>
        @else
            <span class="px-3 py-1 text-gray-400 border rounded">Next</span>
        @endif
    </nav>
@endif

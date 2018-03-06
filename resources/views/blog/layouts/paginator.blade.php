<!-- Pagination -->
@if ($paginator->hasPages())
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-template d-flex justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev"><i class="fa fa-angle-left"></i></a></li>
            @else
                <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev"><i class="fa fa-angle-left"></i></a></li>
            @endif
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item">{{ $element }}</li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a href="" class="page-link">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a href="{{ $url }}" class="page-link">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next"> <i class="fa fa-angle-right"></i></a></li>
            @else
                <li class="page-item disabled"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
            @endif
        </ul>
    </nav>
@endif
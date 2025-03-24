@if ($paginator->hasPages())
    <div class="mt-4 flex justify-between items-center">
        <div class="text-sm text-gray-600">

            @if ($paginator->firstItem())
                Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }}
                entries
            @else
                Showing {{ $paginator->count() }} of {{ $paginator->total() }} entries
            @endif

        </div>

        <div class="flex gap-1">
            @if ($paginator->onFirstPage())
                <button class="px-3 py-1 bg-gray-200 rounded cursor-default" disabled>Previous</button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Previous</a>
            @endif

            @foreach ($elements as $element)


                @if (is_string($element))
                    <span class="px-3 py-1 bg-gray-200 rounded">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button
                                class="px-3 py-1 bg-green-500 text-white rounded cursor-default">{{ $page }}</button>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300 transition">Next</a>
            @else
                <button class="px-3 py-1 bg-gray-200 rounded cursor-default" disabled>Next</button>
            @endif
        </div>
    </div>
@endif

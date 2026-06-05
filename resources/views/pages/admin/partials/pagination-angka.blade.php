@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between shadow-sm rounded-xl p-1 bg-slate-900 text-white w-fit mx-auto sm:mx-0">
        {{-- Tombol Kurang / Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 text-slate-600 cursor-not-allowed text-xs font-bold">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 text-slate-400 hover:text-white transition-colors text-xs font-bold">&lsaquo;</a>
        @endif

        {{-- Elemen Angka --}}
        <div class="flex items-center text-xs font-semibold">
            @foreach ($elements as $element)
                {{-- Pembatas Tiga Titik (Ellipsis) --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-slate-500">{{ $element }}</span>
                @endif

                {{-- Array Link Angka --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 bg-slate-800 text-sky-400 rounded-lg font-bold">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 text-slate-400 hover:text-white transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Tombol Tambah / Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 text-slate-400 hover:text-white transition-colors text-xs font-bold">&rsaquo;</a>
        @else
            <span class="px-3 py-2 text-slate-600 cursor-not-allowed text-xs font-bold">&rsaquo;</span>
        @endif
    </nav>
@endif
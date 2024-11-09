@props(['paginate_data'])
<div class="flex justify-between items-center px-4 py-3">
    <div class="text-sm text-slate-500">
        Showing <b>{{ $paginate_data->currentPage() }} - {{ $paginate_data->lastPage() }}</b> of {{ $paginate_data->total() }}
    </div>
    <div class="flex gap-3">
        <button id="prev_btn" @if ($paginate_data->currentPage() == 1) disabled @endif
            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            Prev
        </button>
        <button id="next_btn" @if ($paginate_data->currentPage() == $paginate_data->lastPage()) disabled @endif
            class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition duration-200 ease">
            Next
        </button>
    </div>
</div>
<script>
    const route = @json($paginate_data->path());
    const next_btn = document.getElementById('next_btn');
    next_btn.addEventListener('click', function(event) {
        navigation.navigate(route + "?page=" + (@json($paginate_data->currentPage()) + 1));
    })
    const prev_btn = document.getElementById('prev_btn');
    prev_btn.addEventListener('click', function(event) {
        navigation.navigate(route + "?page=" + (@json($paginate_data->currentPage()) - 1));
    })
</script>
</div>

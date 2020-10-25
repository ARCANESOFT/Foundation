<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        @include('foundation::_includes.datatable.results-status', compact('paginator'))
    </div>

    {{ $paginator->links() }}
</div>

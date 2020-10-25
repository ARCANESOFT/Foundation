<?php
/** @var  \Illuminate\Contracts\Pagination\LengthAwarePaginator  $paginator */
?>
<div class="d-flex justify-content-between align-items-center">
    <div class="text-muted">
        @lang('Showing :first to :last out of :total results', ['first' => $paginator->firstItem(), 'last' => $paginator->lastItem(), 'total' => $paginator->total()])
    </div>

    {{ $paginator->links() }}
</div>

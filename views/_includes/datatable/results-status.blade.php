<?php /** @var  Illuminate\Pagination\LengthAwarePaginator  $paginator */ ?>

@lang('Showing :first to :last out of :total results', ['first' => $paginator->firstItem(), 'last' => $paginator->lastItem(), 'total' => $paginator->total()])

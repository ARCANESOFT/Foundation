<?php
/**
 * @see  Arcanesoft\Foundation\Views\Components\Pagination\PagesComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag       $attributes
 * @var  Illuminate\Pagination\LengthAwarePaginator  $paginator
 */
?>
<span {{ $attributes->class(['d-inline-block badge border border-secondary text-secondary']) }}>
    @lang('Page :current of :last', ['current' => $paginator->currentPage(), 'last' => $paginator->lastPage()])
</span>

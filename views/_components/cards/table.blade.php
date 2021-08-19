<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Cards\TableComponent
 *
 * @var Illuminate\View\ComponentAttributeBag  $attributes
 */
$attributes = $attributes
    ->class([
        'table',
        'table-borderless',
        'mb-0',
        'table-hover' => $attributes->has('hover'),
    ])
    ->except(['hover'])
;
?>
<table {{ $attributes }}>{{ $slot }}</table>

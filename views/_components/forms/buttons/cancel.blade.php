<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Buttons\CancelComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $to
 */
$attributes = $attributes
    ->merge(['href' => $to])
    ->class(['btn', 'btn-sm', 'btn-light'])
;
?>
<a {{ $attributes }}>@lang('Cancel')</a>

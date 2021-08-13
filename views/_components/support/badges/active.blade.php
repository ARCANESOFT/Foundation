<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Support\Badges\ActiveComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  bool                                   $active
 * @var  bool                                   $icon
 */
$hasIcon = $attributes->has('icon');
$attributes = $attributes
    ->except(['icon'])
    ->class([
        'badge',
        'border',
        'text-muted',
        'border-success' => $active,
        'border-secondary' => ! $active,
    ])
;
$iconClass = $active ? 'fa-check text-success' : 'fa-ban text-secondary';
$title = $active ? 'Activated' : 'Deactivated';
?>
@if($hasIcon)
    <span {{ $attributes }} title="@lang($title)" data-toggle="tooltip">
        <i class="fa fa-fw {{ $iconClass }}"></i>
    </span>
@else
    <span {{ $attributes }}>
        <i class="fa fa-fw {{ $iconClass }} mr-1"></i> @lang($title)
    </span>
@endif


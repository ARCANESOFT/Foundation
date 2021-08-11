<?php
/**
 * @var  bool                                   $locked
 * @var  bool                                   $icon
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 */
$hasIcon = $attributes->has('icon');
$attributes = $attributes
    ->except(['icon'])
    ->class([
        'badge',
        'border',
        'text-muted',
        'border-danger'    => $locked,
        'border-secondary' => ! $locked,
    ])
;
$iconClass = $locked ? 'fa-lock text-danger' : 'fa-unlock text-secondary';
$title = $locked ? 'Locked' : 'Unlocked';
?>
@if($hasIcon)
    <span {{ $attributes }} title="@lang($title)" data-toggle="tooltip">
        <i class="fa fa-fw {{ $iconClass }}"></i>
    </span>
@else
    <span {{ $attributes }}>
        <i class="fa fa-fw {{ $iconClass }} me-1"></i> @lang($title)
    </span>
@endif

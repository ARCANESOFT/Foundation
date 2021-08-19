<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Support\Badges\BadgeComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\HtmlString          $slot
 * @var  string                                 $type
 * @var  string|null                            $label
 */
$attributes = $attributes
    ->except(['type', 'label'])
    ->class([
        'badge',
        'border',
        'border-'.$type,
        'text-muted',
    ])
;
?>
<span {{ $attributes }}>{{ $slot->isNotEmpty() ? $slot : __($label ?: '') }}</span>

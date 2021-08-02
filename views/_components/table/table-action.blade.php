<?php
/**
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $action
 * @var  string                                 $type
 * @var  string                                 $label
 */

$isPrimary      = in_array($type, ['add', 'save']);
$isDestructive  = in_array($type, ['delete', 'detach']);
$isScriptAction = in_array($type, ['activate', 'activate', 'delete', 'detach', 'restore']);

$attributes    = $attributes
    ->merge([
        'data-bs-toggle' => 'tooltip',
        'title'          => __($label),
    ])
    ->class([
        'btn',
        'btn-sm',
        'btn-light',
//        'btn-primary'   => $isPrimary,
        'text-danger'    => $isDestructive,
//        'btn-secondary' => ! ($isPrimary || $isDestructive),
    ])
;

$icon = [
    'add'        => 'fas fa-fw fa-plus',
    'show'       => 'fas fa-fw fa-eye',
    'edit'       => 'far fa-fw fa-edit',
    'activate'   => 'fas fa-fw fa-check',
    'deactivate' => 'fas fa-fw fa-ban',
    'restore'    => 'fas fa-fw fa-trash-restore-alt',
    'delete'     => 'fas fa-fw fa-trash-alt',
][$type];
?>
@if ($isScriptAction)
    <button onclick="ARCANESOFT.emit({{ $action }})" {{ $attributes }}>
        <i class="{{ $icon }}"></i>
    </button>
@else
    <a href="{{ $action }}" {{ $attributes }}>
        <i class="{{ $icon }}"></i>
    </a>
@endif

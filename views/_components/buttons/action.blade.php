<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Buttons\ActionComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $type
 * @var  string                                 $action
 */
$isPrimary      = in_array($type, ['add', 'create', 'save']);
$isDestructive  = in_array($type, ['delete', 'detach']);
$isScriptAction = in_array($type, ['activate', 'deactivate', 'delete', 'detach', 'restore']);

$attributes = $attributes
    ->class([
        'btn',
        'btn-sm',
        'btn-primary'   => $isPrimary,
        'btn-danger'    => $isDestructive,
        'btn-secondary' => ! ($isPrimary || $isDestructive),
        'active'        => is_active($action)
    ])
;
?>
@if ($isScriptAction)
    <button onclick="ARCANESOFT.emit('{{ $action }}')" {{ $attributes }}>@lang(ucfirst($type))</button>
@else
    <a href="{{ $action }}" {{ $attributes }}>
        @if(in_array($type, ['add', 'create']))<i class="fas fa-fw fa-plus me-1"></i>@endif @lang(ucfirst($type))
    </a>
@endif

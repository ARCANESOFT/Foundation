<?php
/**
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $type
 */

$isPrimary      = in_array($type, ['add', 'save']);
$isDestructive  = in_array($type, ['delete', 'detach']);
$isScriptAction = in_array($type, ['activate', 'deactivate', 'delete', 'detach', 'restore']);

$attributes    = $attributes->class([
    'btn',
    'btn-sm',
    'btn-primary'   => $isPrimary,
    'btn-danger'    => $isDestructive,
    'btn-secondary' => ! ($isPrimary || $isDestructive),
])
?>
@if ($isScriptAction)
    <button onclick="ARCANESOFT.emit('{{ $action }}')" {{ $attributes }}>@lang(ucfirst($type))</button>
@else
    <a href="{{ $action }}" {{ $attributes }}>
        @if($type === 'add')<i class="fas fa-fw fa-plus me-1"></i>@endif @lang(ucfirst($type))
    </a>
@endif

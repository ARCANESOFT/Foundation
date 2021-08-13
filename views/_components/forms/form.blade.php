<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\FormComponent
 * 
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  string                                 $method
 * @var  string                                 $action
 * @var  string                                 $hasFiles
 */
$attributes = $attributes
    ->except(['action'])
    ->merge([
        'action' => $action,
        'method' => $method !== 'GET' ? 'POST' : 'GET',
    ])
;
if ($hasFiles)
    $attributes = $attributes->merge(['enctype' => 'multipart/form-data'])
?>
<form {{ $attributes }}>
    @csrf
    @method($method)
    {{ $slot }}
</form>

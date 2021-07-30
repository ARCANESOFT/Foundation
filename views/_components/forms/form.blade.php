<?php
/**
 * @var  string                                 $method
 * @var  string                                 $action
 * @var  string                                 $hasFiles
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
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

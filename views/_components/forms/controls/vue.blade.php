<?php
/**
 * @var  string                                 $id
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */
$attributes = $attributes
    ->merge([
        'name' => $name,
        'id'   => $id,
    ])
    ->class([
        'is-invalid' => $errors->has($name),
    ])
;
?>
<x-arc:form-label :for="$id" :label="$label"/>
<{{$use}} {{ $attributes }}>{{ $slot }}</{{$use}}>
<x-arc:form-error :name="$name"/>

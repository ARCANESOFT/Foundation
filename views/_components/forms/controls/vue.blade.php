<?php
/**
 * @var  string                                 $id
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */

$attributes = $attributes->merge([
    'name'  => $name,
    'id'    => $id,
    'class' => $errors->first($name, ' is-invalid'),
]);
?>

<x-arc:form-label :for="$id" :label="$label"/>
<{{$component}} {{ $attributes }}>{{ $slot }}</{{$component}}>
<x-arc:form-error :name="$name"/>

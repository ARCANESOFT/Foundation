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
    'class' => 'form-control'.$errors->first($name, ' is-invalid'),
]);
?>

<x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
<textarea {{ $attributes }}>@if($value){{ $value }}@endif</textarea>
<x-arc:form-error name="{{ $name }}"/>


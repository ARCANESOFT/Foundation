<?php
/**
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */

$attributes = $attributes->merge([
    'class' => 'form-control'.$errors->first($name, ' is-invalid'),
]);
?>

@if($grouped)
<div class="form-label-group">
    <input type="password" id="{{ $id }}" name="{{ $name }}" {{ $attributes }}>
    <label for="{{ $name }}">{{ $label }}</label>
    <x-arc:form-error name="{{ $name }}"/>
</div>
@else
    <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
    <input type="password" id="{{ $id }}" name="{{ $name }}" {{ $attributes }}>
    <x-arc:form-error name="{{ $name }}"/>
@endif

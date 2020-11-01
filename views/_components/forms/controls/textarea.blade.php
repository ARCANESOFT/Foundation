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

@if($grouped)
    <div class="form-floating">
        <textarea {{ $attributes }}>{{ $slot->isEmpty() ? $value : $slot }}</textarea>
        <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
        <x-arc:form-error name="{{ $name }}"/>
    </div>
@else
    <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
    <textarea {{ $attributes }}>{{ $slot->isEmpty() ? $value : $slot }}</textarea>
    <x-arc:form-error name="{{ $name }}"/>
@endif


<?php
/**
 * @var  string                                 $type
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */

$attributes = $attributes->merge([
    'type'  => $type,
    'name'  => $name,
    'id'    => $id,
    'class' => 'form-control'.$errors->first($name, ' is-invalid'),
]);
?>

@if($grouped)
    <div class="form-floating">
        <input {{ $attributes->merge(['placeholder' => __($label)]) }} @if($value)value="{{ $value }}"@endif>
        <x-arc:form-label :for="$id" :label="$label"/>
        <x-arc:form-error :name="$name"/>
    </div>
@else
    <x-arc:form-label :for="$id" :label="$label"/>
    <input {{ $attributes }} @if($value)value="{{ $value }}"@endif>
    <x-arc:form-error :name="$name"/>
@endif

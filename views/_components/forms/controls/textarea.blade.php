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
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
;
?>
@if($grouped)
    <div class="form-floating">
        <textarea {{ $attributes }}>{{ old($name, $slot->isEmpty() ? $value : $slot) }}</textarea>
        <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
        <x-arc:form-error :name="$name"/>
    </div>
@else
    <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
    <textarea {{ $attributes }}>{{ old($name, $slot->isEmpty() ? $value : $slot) }}</textarea>
    <x-arc:form-error :name="$name"/>
@endif


<?php
/**
 * @var  string                                 $type
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  string|null                            $help
 * @var  mixed                                  $value
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */
$hasHelpText = ! is_null($help);
$attributes = $attributes
    ->except(['type', 'name', 'id', 'value', 'help'])
    ->merge([
        'aria-describedby' => $hasHelpText ? $id.'-help' : null,
    ])
    ->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
;
?>
@if($grouped)
    <div class="form-floating">
        <x-arc:input :type="$type" :name="$name" :id="$id" :value="old($name, $value)" {{ $attributes->merge(['placeholder' => __($label)]) }}/>
        <x-arc:form-label :for="$id" :label="$label"/>
        <x-arc:form-error :name="$name"/>
        <x-arc:form-help-text :id="$id" :text="$help"/>
    </div>
@else
    <x-arc:form-label :for="$id" :label="$label"/>
    <x-arc:input :type="$type" :name="$name" :id="$id" :value="old($name, $value)" {{ $attributes }}/>
    <x-arc:form-error :name="$name"/>
    <x-arc:form-help-text :id="$id" :text="$help"/>
@endif

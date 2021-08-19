<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Controls\PasswordComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  string|null                            $help
 */
$hasHelpText = ! is_null($help);
$attributes = $attributes
    ->except(['type', 'value', 'help'])
    ->merge([
        'name'             => $name,
        'id'               => $id,
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
        <input type="password" {{ $attributes->merge(['placeholder' => __($label)]) }}/>
        <x-arc:form-label :for="$id" :label="$label"/>
        <x-arc:form-error :name="$name"/>
        <x-arc:form-help-text :id="$id" :text="$help"/>
    </div>
@else
    <x-arc:form-label :for="$id" :label="$label"/>
    <input type="password" {{ $attributes }}/>
    <x-arc:form-error :name="$name"/>
    <x-arc:form-help-text :id="$id" :text="$help"/>
@endif

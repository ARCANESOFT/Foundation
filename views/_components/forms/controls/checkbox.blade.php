<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Controls\CheckboxComponent
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
    ->except(['type', 'id', 'name', 'value', 'help'])
    ->merge([
        'aria-describedby' => $hasHelpText ? $id.'-help' : null,
    ])
    ->class([
        'form-check-input',
        'is-invalid' => $errors->has($name),
    ])
;
?>
<div class="form-check">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $attributes }} {{ $checked ? 'checked' : '' }}/>
    <label class="form-check-label" for="{{ $id }}">@lang($label)</label>
</div>
<x-arc:form-error :name="$name"/>
<x-arc:form-help-text :id="$id" :text="$help"/>

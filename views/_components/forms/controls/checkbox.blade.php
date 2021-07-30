<?php
/**
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */
$attributes = $attributes
    ->except(['type', 'id', 'name', 'value'])
    ->class(['form-check-input', 'is-invalid' => $errors->has($name)])
;
?>
<div class="form-check">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $attributes }} {{ $checked ? 'checked' : '' }}/>
    <label class="form-check-label" for="{{ $id }}">@lang($label)</label>
</div>
<x-arc:form-error :name="$name"/>

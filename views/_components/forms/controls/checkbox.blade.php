<?php
/**
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */

$attributes = $attributes->merge([
    'class' => 'form-check-input'.$errors->first($name, ' is-invalid'),
]);
?>

<div class="form-check">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}"
           value="{{ $value }}" {{ $attributes }} {{ $checked ? 'checked' : '' }}>
    <label class="form-check-label" for="{{ $name }}">@lang($label)</label>
</div>

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
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" @if($value)value="{{ $value }}"@endif {{ $attributes }}>
        <label for="{{ $name }}">{{ $label }}</label>
        @error($name)
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
@else
    <label for="{{ $name }}" class="form-label font-weight-light text-uppercase text-muted">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" @if($value)value="{{ $value }}"@endif {{ $attributes }}>
    @error($name)
    <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
@endif

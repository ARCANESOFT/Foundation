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

<label for="{{ $id }}" class="form-label font-weight-light text-uppercase text-muted">{{ $label }}</label>
<textarea {{ $attributes }}>@if($value){{ $value }}@endif</textarea>
@error($name)
<span class="invalid-feedback" role="alert">{{ $message }}</span>
@enderror


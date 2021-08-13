<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Controls\VueComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 * @var  string                                 $id
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  string|null                            $help
 */
$hasHelpText = ! is_null($help);
$attributes = $attributes
    ->merge([
        'name'             => $name,
        'id'               => $id,
        'aria-describedby' => $hasHelpText ? $id.'-help' : null,
    ])
    ->class([
        'is-invalid' => $errors->has($name),
    ])
;
?>
<x-arc:form-label :for="$id" :label="$label"/>
<{{$use}} {{ $attributes }}>{{ $slot }}</{{$use}}>
<x-arc:form-error :name="$name"/>
<x-arc:form-help-text :id="$id" :text="$help"/>

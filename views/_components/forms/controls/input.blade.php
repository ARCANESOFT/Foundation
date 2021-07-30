<?php
/**
 * @var  string                                 $type
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  mixed                                  $value
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */
$attributes = $attributes
    ->merge([
        'type'  => $type,
        'name'  => $name,
        'id'    => $id,
        'value' => old($name, $value),
    ])
    ->class(['form-control', 'is-invalid' => $errors->has($name)])
;
?>
@if($grouped)
    <div class="form-floating">
        <input {{ $attributes->merge(['placeholder' => __($label)]) }}>
        <x-arc:form-label :for="$id" :label="$label"/>
        <x-arc:form-error :name="$name"/>
    </div>
@else
    <x-arc:form-label :for="$id" :label="$label"/>
    <input {{ $attributes }}>
    <x-arc:form-error :name="$name"/>
@endif

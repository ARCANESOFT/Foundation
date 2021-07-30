<?php
/**
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */
$attributes = $attributes
    ->except(['type', 'value'])
    ->merge([
        'name'  => $name,
        'id'    => $id,
    ])
    ->class(['form-control', 'is-invalid' => $errors->has($name)])
;
?>
@if($grouped)
    <div class="form-floating">
        <input type="password" {{ $attributes->merge(['placeholder' => __($label)]) }}/>
        <x-arc:form-label :for="$id" :label="$label"/>
        <x-arc:form-error :name="$name"/>
    </div>
@else
    <x-arc:form-label :for="$id" :label="$label"/>
    <input type="password" {{ $attributes }}/>
    <x-arc:form-error :name="$name"/>
@endif

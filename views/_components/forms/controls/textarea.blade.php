<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Controls\TextareaComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 * @var  string                                 $id
 * @var  string                                 $name
 * @var  string                                 $label
 * @var  string|null                            $help
 */
$attributes = $attributes
    ->except(['type', 'value', 'help'])
    ->merge([
        'name' => $name,
        'id'   => $id,
    ])
    ->class([
        'form-control',
        'is-invalid' => $errors->has($name),
    ])
;
?>
@if($grouped)
    <div class="form-floating">
        <textarea {{ $attributes }}>{{ old($name, $slot->isEmpty() ? $value : $slot) }}</textarea>
        <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
        <x-arc:form-error :name="$name"/>
        <x-arc:form-help-text :id="$id" :text="$help"/>
    </div>
@else
    <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
    <textarea {{ $attributes }}>{{ old($name, $slot->isEmpty() ? $value : $slot) }}</textarea>
    <x-arc:form-error :name="$name"/>
    <x-arc:form-help-text :id="$id" :text="$help"/>
@endif


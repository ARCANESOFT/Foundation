<?php
/**
 * @see \Arcanesoft\Foundation\Views\Components\Forms\Controls\SelectComponent
 *
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  string                                 $help
 */
$hasHelpText = ! is_null($help);
$attributes = $attributes
    ->except(['help'])
    ->merge([
        'name'             => $name,
        'id'               => $id,
        'aria-describedby' => $hasHelpText ? $id.'-help' : null,
    ])
    ->class([
        'form-select',
        'is-invalid' => $errors->has($name),
    ])
;
?>
@if($grouped)
    <div class="form-floating">
        <select {{ $attributes }}>
            @unless(empty($options))
                @foreach($options as $key => $option)
                    @if($key === $value)
                        <option value="{{ $key }}" selected>{{ $option }}</option>
                    @else
                        <option value="{{ $key }}">{{ $option }}</option>
                    @endif
                @endforeach
            @else
                {{ $slot }}
            @endunless
        </select>
        <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
        <x-arc:form-error name="{{ $name }}"/>
        <x-arc:form-help-text :id="$id" :text="$help"/>
    </div>
@else
    <x-arc:form-label for="{{ $id }}" label="{{ $label }}"/>
    <select {{ $attributes }}>
        @unless(empty($options))
            @foreach($options as $key => $option)
                @if($key === $value)
                    <option value="{{ $key }}" selected>{{ $option }}</option>
                @else
                    <option value="{{ $key }}">{{ $option }}</option>
                @endif
            @endforeach
        @else
            {{ $slot }}
        @endunless
    </select>
    <x-arc:form-error name="{{ $name }}"/>
    <x-arc:form-help-text :id="$id" :text="$help"/>
@endif


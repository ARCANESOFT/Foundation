<?php
/**
 * @var  string                                 $name
 * @var  string                                 $id
 * @var  string                                 $label
 * @var  Illuminate\View\ComponentAttributeBag  $attributes
 * @var  Illuminate\Support\ViewErrorBag        $errors
 */

$attributes = $attributes->merge([
    'name'  => $name,
    'id'    => $id,
    'class' => 'form-select'.$errors->first($name, ' is-invalid'),
]);
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
@endif

